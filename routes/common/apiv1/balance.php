<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiV1\User\BalanceController;

/*
|--------------------------------------------------------------------------
| Balance API Routes
|--------------------------------------------------------------------------
|
| 用户余额相关路由
|
*/

Route::middleware(['auth:sanctum'])->prefix('api/v1/user')->group(function () {
    // 获取用户余额
    Route::get('/balance', [BalanceController::class, 'getBalance']);
    
    // 创建充值订单
    Route::post('/balance/recharge', [BalanceController::class, 'createRechargeOrder']);
    
    // 获取充值订单列表
    Route::get('/balance/recharge-orders', [BalanceController::class, 'getRechargeOrders']);
    
    // 获取余额变动记录
    Route::get('/balance/logs', [BalanceController::class, 'getBalanceLogs']);
});