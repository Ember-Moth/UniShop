<?php

namespace App\Http\Controllers\ApiV1;
use App\Exceptions\RuleValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class SystemSettingController extends Controller
{


    public function getSystemSetting(Request $request)
    {
        $key = $request->input('key');
        
        if (empty($key)) {
            return response()->json([
                'code' => 400,
                'message' => '参数错误：key 不能为空'
            ], 400);
        }
        return response()->json([
            'code'    => 200,
            'message' => '获取配置成功',
            'data'    => [
                $key    => dujiaoka_config_get($key)
            ]
        ]);
    }


    public function getSystemSettings(Request $request): \Illuminate\Http\JsonResponse
    {
        $keys = $request->input('keys');
        
        if (!is_array($keys)) {
            return response()->json([
                'code' => 400,
                'message' => '参数错误：keys 必须是数组'
            ], 400);
        }
        
        $data = [];
        foreach ((array)$keys as $key) {
            $key = trim($key);
            if (!empty($key)) {
                $data[$key] = dujiaoka_config_get($key);
            }
        }
        
        return response()->json([
            'code'    => 200,
            'message' => '获取配置成功',
            'data'    => $data
            ]);
    }

    public function getBaseSystemSettings(Request $request): \Illuminate\Http\JsonResponse
    {
        $keys = [
            "title",
            "img_logo",
            "text_logo",
            "keywords",
            "description",
            "template",
            "language",
            "manage_email",
            "order_expire_time",
            "is_open_anti_red",
            "is_open_img_code",
            "is_open_search_pwd",
            "is_open_google_translate",
            "is_open_email_otp",
            "notice",
            "footer"
        ];

        if (!is_array($keys)) {
            return response()->json([
                'code' => 400,
                'message' => '参数错误：keys 必须是数组'
            ], 400);
        }

        $data = [];
        foreach ((array)$keys as $key) {
            $key = trim($key);
            if (!empty($key)) {
                $data[$key] = dujiaoka_config_get($key);
            }
        }

        return response()->json([
            'code'    => 200,
            'message' => '获取配置成功',
            'data'    => $data
        ]);
    }
}