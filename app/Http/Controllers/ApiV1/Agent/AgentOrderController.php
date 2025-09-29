<?php

namespace App\Http\Controllers\ApiV1\Agent;
use App\Exceptions\RuleValidationException;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Service\AgentOrderProcessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AgentOrderController extends Controller
{
    /**
     * 订单服务层
     * @var \App\Service\ApiOrderService
     */
    private $apiOrderService;
    /**
     * 订单处理层.
     * @var AgentOrderProcessService
     */
    private $agentOrderProcessService;


    public function __construct()
    {
        $this->apiOrderService          = app('Service\ApiOrderService');
        $this->agentOrderProcessService = app('Service\AgentOrderProcessService');
    }
    public function createAgentOrder(Request $request){
        $user = $request->user();
        if(empty($user)){
            $params = $request->all();
            $user = User::where('id', $params['agent_id'])->first();
        }
        Log::info("createAgentOrder",['user'=>$user]);
        DB::beginTransaction();
        try {
            $this->apiOrderService->validatorCreateOrder($request);
            $goods = $this->apiOrderService->validatorGoods($request);
            $this->apiOrderService->validatorLoopCarmis($request);
            // 设置商品
            $this->agentOrderProcessService->setGoods($goods);
            $otherIpt = $this->apiOrderService->validatorChargeInput($goods, $request);
            $this->agentOrderProcessService->setOtherIpt($otherIpt);
            // 数量
            $this->agentOrderProcessService->setBuyAmount($request->input('buy_amount'));

            // 支付方式
            $this->agentOrderProcessService->setPayID(0);
//            $this->agentOrderProcessService->setPayID($request->input('payway'));
            // 下单邮箱
            $this->agentOrderProcessService->setEmail($request->input('email'));
            // ip地址
            $this->agentOrderProcessService->setBuyIP($request->getClientIp());
            // 查询密码
            $this->agentOrderProcessService->setSearchPwd($request->input('search_pwd', ''));
            // 设置
            $this->agentOrderProcessService->setAgentOrderSn($request->input('supplier_order_sn', ''));

            // 创建订单
            $order = $this->agentOrderProcessService->createOrder($user->id);

            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => [
                    'order_sn' => $order->order_sn,
                ]
            ]);
        } catch (RuleValidationException $exception) {
            Log::error("createAgentOrder",['exception'=>$exception->getMessage(),'trace'=>$exception->getTraceAsString()]);
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'message' => $exception->getMessage(),
                'data' => null
            ]);
        }
    }
}