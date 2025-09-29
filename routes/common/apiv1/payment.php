<?php
/**
 * API V1 支付相关路由
 *
 * @author    assimon<ashang@utf8.hk>
 * @copyright assimon<ashang@utf8.hk>
 * @link      http://utf8.hk/
 */
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1', 'namespace' => 'ApiV1'], function () {
    // 获取支持的支付方式列表
    Route::get('payment/methods', 'PaymentController@getPaymentMethods');
    // 创建支付订单
    Route::post('payment/create', 'PaymentController@createPayment');

    // 支付相关路由（需要认证）
    Route::group(['middleware' => 'auth:sanctum'], function () {
        // 创建支付订单
        Route::post('payment/user/create', 'PaymentController@userCreatePayment');
    });
    
    // 支付回调（不需要认证）
    Route::post('payment/notify/{payment_type}', 'PaymentController@paymentNotify');
});
