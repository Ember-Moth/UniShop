<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Carmis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class GoodsController extends Controller
{
    /**
     * 获取所有商品列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            // 获取查询参数
            $page = $request->input('page', 1);
            $perPage = $request->input('per_page', 15);
            $groupId = $request->input('group_id');
            $type = $request->input('type');
            $keyword = $request->input('keyword');

            // 构建查询
            $query = Goods::with(['group'])
                ->where('is_open', Goods::STATUS_OPEN)
                ->orderBy('ord', 'asc')
                ->orderBy('id', 'desc');

            // 按分类筛选
            if ($groupId) {
                $query->where('group_id', $groupId);
            }

            // 按类型筛选
            if ($type) {
                $query->where('type', $type);
            }

            // 关键词搜索
            if ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('gd_name', 'like', "%{$keyword}%")
                      ->orWhere('gd_description', 'like', "%{$keyword}%")
                      ->orWhere('gd_keywords', 'like', "%{$keyword}%");
                });
            }

            // 获取商品列表
            $goods = $query->paginate($perPage, ['*'], 'page', $page);

            // 处理商品数据
            $goodsData = $goods->getCollection()->map(function ($item) {
                return $this->formatGoodsData($item);
            });

            return response()->json([
                'code' => 200,
                'message' => '获取成功',
                'data' => $goodsData,
                'pagination' => [
                    'current_page' => $goods->currentPage(),
                    'per_page' => $goods->perPage(),
                    'total' => $goods->total(),
                    'last_page' => $goods->lastPage(),
//                    'from' => $goods->firstItem(),
//                    'to' => $goods->lastItem()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => '获取商品列表失败：' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

   /**
    * 商品详情
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $goods = Goods::with(['group'])
                ->where('is_open', Goods::STATUS_OPEN)
                ->find($id);

            if (!$goods) {
                return response()->json([
                    'code' => 404,
                    'message' => '商品不存在',
                    'data' => null
                ], 404);
            }

            $goodsData = $this->formatGoodsData($goods);

            return response()->json([
                'code' => 200,
                'message' => '获取成功',
                'data' => $goodsData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => '获取商品详情失败：' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }


    /**
     * 热门商品
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function hot(Request $request)
    {
        try {
            $limit = $request->input('limit', 10);

            $goods = Goods::with(['group'])
                ->where('is_open', Goods::STATUS_OPEN)
                ->orderBy('sales_volume', 'desc')
                ->orderBy('ord', 'asc')
                ->limit($limit)
                ->get();

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
            ], 500);
        }
    }


    /**
     * 商品分类列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function categories()
    {
        try {
            $categories = \App\Models\GoodsGroup::select('id', 'gp_name')
                ->withCount(['goods' => function ($query) {
                    $query->where('is_open', Goods::STATUS_OPEN);
                }])
                ->orderBy('ord', 'asc')
                ->get();

            return response()->json([
                'code' => 200,
                'message' => '获取成功',
                'data' => $categories
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => '获取商品分类失败：' . $e->getMessage(),
                'data' => null
            ], 500);
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
        $goods = $this->format($goods);

        return [
            'id' => $goods->id,
            'gd_name' => $goods->gd_name,
            'gd_description' => $goods->gd_description,
            'gd_keywords' => $goods->gd_keywords,
            'picture' => $goods->picture ? url($goods->picture) : null,
            'retail_price' => number_format($goods->retail_price, 2),
            'actual_price' => number_format($goods->actual_price, 2),
            'in_stock' => $inStock,
            'sales_volume' => $goods->sales_volume,
            'type' => $goods->type,
            'type_text' => $goods->type == Goods::AUTOMATIC_DELIVERY ? '自动发货' : '人工处理',
            'is_open' => $goods->is_open,
            'is_open_text' => $goods->is_open == Goods::STATUS_OPEN ? '开启' : '关闭',
            'buy_limit_num' => $goods->buy_limit_num,
            'buy_prompt' => $goods->buy_prompt,
            'description' => $goods->description,
            'ord' => $goods->ord,
            'wholesale_price_cnf' => $goods->wholesale_price_cnf,
            'other_ipu' => $goods->other_ipu,
            'other_ipu_cnf' => $goods->other_ipu_cnf,
            'created_at' => $goods->created_at,
            'updated_at' => $goods->updated_at,
            'group' => $goods->group ? [
                'id' => $goods->group->id,
                'gp_name' => $goods->group->gp_name
            ] : null
        ];
    }

    /**
     * 格式化商品信息
     *
     * @param Goods $goods 商品模型
     * @return Goods
     *
     * @author    assimon<ashang@utf8.hk>
     * @copyright assimon<ashang@utf8.hk>
     * @link      http://utf8.hk/
     */
    public function format(Goods $goods)
    {
        // 格式化批发配置以及输入框配置
        $goods->wholesale_price_cnf = $goods->wholesale_price_cnf ?
            format_wholesale_price($goods->wholesale_price_cnf) :
            null;
        // 如果存在其他配置输入框且为代充
        $goods->other_ipu = $goods->other_ipu_cnf ?
            format_charge_input($goods->other_ipu_cnf) :
            null;
        return $goods;
    }
}
