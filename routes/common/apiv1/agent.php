<?php
/**
 * API V1 代理商相关路由
 *
 * @author    assimon<ashang@utf8.hk>
 * @copyright assimon<ashang@utf8.hk>
 * @link      http://utf8.hk/
 */

use App\Http\Controllers\ApiV1\Agent\AgentConfigController;
use App\Http\Controllers\ApiV1\Agent\AgentGoodsController;
use App\Http\Controllers\ApiV1\Agent\AgentOrderController;
use App\Http\Controllers\ApiV1\Agent\AgentUserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1', 'namespace' => 'ApiV1'], function () {
    // 用户信息（需要认证）
    Route::group(['middleware' => 'auth:sanctum'], function () {
        //获取代理商配置
        Route::get('agent/config', [AgentConfigController::class, 'config']);
    });

    Route::group(['prefix' => 'agent','middleware' => 'agent.auth'], function () {
        // 获取商品分类列表
        Route::post('/group-list', [AgentGoodsController::class, 'getGoodsCategories']);
        // 获取商品列表
        Route::post('/goods-list', [AgentGoodsController::class, 'getGoodsList']);
        // 检查商品
        Route::post('/validate-goods', [AgentGoodsController::class, 'validateGoods']);
        // 获取余额
        Route::post('/balance', [AgentUserController::class, 'getAgentUserBalance']);
        // 下单
        Route::post('/buy-goods', [AgentOrderController::class, 'createAgentOrder']);

    });
});

