<?php
/**
 * API V1 用户相关路由
 *
 * @author    assimon<ashang@utf8.hk>
 * @copyright assimon<ashang@utf8.hk>
 * @link      http://utf8.hk/
 */
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'api/v1', 'namespace' => 'ApiV1'], function () {
    //
    Route::post('user/otp/register', 'UserController@sendRegisterEmail');
    Route::post('user/reset-password', 'UserController@resetPassword');


    Route::post('user/otp/forget-password', 'UserController@sendForgetEmail');
    // 用户注册
    Route::post('user/register', 'UserController@register');

    // 用户登录
    Route::post('user/login', 'UserController@login');
    
    // 用户信息（需要认证）
    Route::group(['middleware' => 'auth:sanctum'], function () {
        // 获取用户信息
        Route::get('user/info', 'UserController@info');
        Route::get('user/amount', 'UserController@amount');

        // 更新用户信息
//        Route::post('user/update', 'UserController@update');
        
        // 修改密码
        Route::post('user/change-password', 'UserController@changePassword');
        
        // 用户登出
        Route::post('user/logout', 'UserController@logout');
    });

});
