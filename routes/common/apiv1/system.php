<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1', 'namespace' => 'ApiV1'], function () {

    Route::post('system-setting', 'SystemSettingController@getSystemSetting');
    // 用户注册
    Route::post('system-settings', 'SystemSettingController@getSystemSettings');
    Route::post('base-system-settings', 'SystemSettingController@getBaseSystemSettings');

});
