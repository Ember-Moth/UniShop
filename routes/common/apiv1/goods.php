<?php
/**
 * API V1 商品相关路由
 *
 * @author    assimon<ashang@utf8.hk>
 * @copyright assimon<ashang@utf8.hk>
 * @link      http://utf8.hk/
 */
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1', 'namespace' => 'ApiV1'], function () {
    // 商品相关接口（公开接口，无需认证）
    Route::group(['prefix' => 'goods'], function () {
        // 获取商品列表
        Route::get('/list', 'GoodsController@index');
        
        // 获取商品详情
        Route::get('/{id}', 'GoodsController@show');
        
        // 获取热门商品
        Route::get('/hot/list', 'GoodsController@hot');
        
        // 获取商品分类
        Route::get('/category/list', 'GoodsController@categories');
    });
});
