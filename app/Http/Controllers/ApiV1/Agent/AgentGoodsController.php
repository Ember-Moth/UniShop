<?php

namespace App\Http\Controllers\ApiV1\Agent;
use App\Exceptions\RuleValidationException;
use App\Http\Controllers\Controller;
use App\Models\Carmis;
use App\Models\Goods;
use App\Models\Supplier;
use App\Service\GoodsService;
use App\Service\SupplierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AgentGoodsController extends Controller
{

    /**
     * 获取商品分类
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGoodsCategories(Request $request){
        try {
            $categories = \App\Models\GoodsGroup::select('id', 'gp_name')
                ->withCount(['goods' => function ($query) {
                    $query->where('is_open', Goods::STATUS_OPEN);
                }])
                ->orderBy('ord', 'asc')
                ->get();
            $groupData = $categories->map(function ($item) {
                return [
                    'group_id' => $item->id,
                    'group_name'=>$item->gp_name
                ];
            });

            return response()->json([
                'code' => 200,
                'message' => '获取成功',
                'data' => $groupData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => '获取商品分类失败：' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function getGoodsList(Request $request){
        try {
            $groupId = $request->input('group_id');
            $query = Goods::where('is_open', Goods::STATUS_OPEN)
                ->orderBy('sales_volume', 'desc')
                ->orderBy('id', 'desc');
            // 按分类筛选
            if ($groupId) {
                $query->where('group_id', $groupId);
            }
            $goods= $query->get();

            $goodsData = $goods->map(function ($item) {
                return $this->formatGoodsData($item);
            });

            return response()->json([
                'code' => 200,
                'message' => '获取成功',
                'data' => $goodsData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => '获取热门商品失败：' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function validateGoods(Request $request)
    {
        $goodsService = app(GoodsService::class);
        try{
            // 获得商品详情
            $goods = $goodsService->detail($request->input('gid'));
            // 商品状态验证
            $goodsService->validatorGoodsStatus($goods);
            // 如果有限购
            if ($goods->buy_limit_num > 0 && $request->input('buy_amount') > $goods->buy_limit_num) {
                throw new RuleValidationException(__('dujiaoka.prompt.purchase_limit_exceeded'));
            }
            // 库存不足
            if ($request->input('buy_amount') > $goods->in_stock) {
                throw new RuleValidationException(__('dujiaoka.prompt.inventory_shortage'));
            }

            if($goods->isSupplierGoods()){
                $supplier = Supplier::query()->where('id', $goods->supplier_id)->first();
                if($supplier){
                    $supplierService = new SupplierService($supplier['method'],$goods->supplier_id);
                    //todo 检查上游商品是否可以下单
                    $res = $supplierService->validateGoods($request->input('gid'),$request->input('buy_amount'));
                    Log::info("检查上游商品是否可以下单:".json_encode($res));
                    return $res;
                }else{
                    throw new RuleValidationException(__('dujiaoka.prompt.goods_does_not_exist'));
                }
            }

            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => [
                    'validate' => 1,
                ]
            ]);
        }catch (RuleValidationException $e){
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
                'data' => [
                    'validate' => 0,
                ]
            ]);
        }

    }

    /**
     * 格式化商品数据
     *
     * @param Goods $goods
     * @return array
     */
    private function formatGoodsData($goods)
    {
        // 计算实际库存
        $inStock = $goods->in_stock;
        if ($goods->type == Goods::AUTOMATIC_DELIVERY) {
            // 自动发货商品，计算未出售的卡密数量
            $inStock = Carmis::where('goods_id', $goods->id)
                ->where('status', Carmis::STATUS_UNSOLD)
                ->count();
        }

        return [
            'goods_id' => $goods->id,
            'goods_name' => $goods->gd_name,
            'goods_description' => $goods->gd_description,
            'goods_keywords' => $goods->gd_keywords,
            'picture' => $goods->picture ? url($goods->picture) : null,
            'price' => number_format($goods->actual_price, 2),
            'in_stock' => $inStock,
            'sales_volume' => $goods->sales_volume,
            'type' => $goods->type,
            'type_text' => $goods->type == Goods::AUTOMATIC_DELIVERY ? '自动发货' : '人工处理',
            'buy_limit_num' => $goods->buy_limit_num,
            'buy_prompt' => $goods->buy_prompt,
            'description' => $goods->description,
            'other_ipu_cnf' => $goods->other_ipu_cnf,
        ];
    }
}