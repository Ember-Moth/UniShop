<?php

namespace App\Http\Controllers\ApiV1\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class AgentConfigController extends Controller
{

    /**
     * 获取代理商配置
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function config(Request $request){
        $user = $request->user();
        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => [
                'agent_id' => $user->id,
                'secret_key' => $user->secret_key,
                'api_url' => url('/'),
//                'get_goods_list_url' => url('api/v1/agent/goods-list'),
//                'get_balance_url' => url('api/v1/agent/balance'),
//                'buy_goods_url' => url('api/v1/agent/buy_goods'),
            ]
        ]);
    }
}