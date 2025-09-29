<?php
/**
 * API V1 供应商相关路由
 *
 * @author    UniShop Team
 */

use App\Http\Controllers\ApiV1\Supplier\SupplierController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1/supplier', 'namespace' => 'ApiV1\Supplier', 'middleware' => 'auth:sanctum'], function () {
    // 获取供应商扩展字段列表
    Route::get('form-extend-attributes', [SupplierController::class,'getFormExtendAttributes']);
    // 获取供应商列表
    Route::get('list', 'SupplierController@index');

    // 创建供应商配置
    Route::post('create', 'SupplierController@create');

    // 获取供应商详情
    Route::get('detail/{id}', 'SupplierController@show');

    // 更新供应商配置
    Route::put('update/{id}', 'SupplierController@update');

    // 删除供应商配置
    Route::delete('delete/{id}', 'SupplierController@destroy');

    // 切换供应商状态
    Route::post('enable/{id}', 'SupplierController@toggleStatus');

});