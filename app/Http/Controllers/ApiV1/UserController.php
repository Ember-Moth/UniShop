<?php

namespace App\Http\Controllers\ApiV1;

use App\Exceptions\RuleValidationException;
use App\Http\Controllers\Controller;
use App\Models\EmailOtpLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    /**
     * 发送重置密码邮件
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendForgetEmail(Request $request){
        $validator = Validator::make($request->all(), [
            'email'                 => 'required|email',
        ], [
            'email.required'                 => '邮箱地址不能为空',
            'email.email'                    => '邮箱地址格式不正确',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code'    => 400,
                'message' => $validator->errors()->first(),
                'data'    => null
            ], 400);
        }

        try {
            if(!(User::where('email',$request->email)->exists())){
                return response()->json([
                    'code'    => 400,
                    'message' => "用户不存在",
                    'data'    => null
                ], 400);
            }
            $res = app("Service\EmailOtpService")->sendEmailOtp($request->input('email'), EmailOtpLog::TYPE_FORGET);

            return response()->json([
                'code'    => 200,
                'message' => '发送成功',
                'data'    => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code'    => 500,
                'message' => '发送失败：' . $e->getMessage(),
                'data'    => null
            ], 500);
        }
    }


    /**
     * 重置密码
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'                 => 'required|email',
            'code'                 => 'required',
            'password'              => 'required|string|min:6',
            'password_confirmation' => 'required|same:password',
        ], [
            'email.required'                 => '邮箱地址不能为空',
            'code.required'                 => '验证码不能为空',
            'email.email'                    => '邮箱地址格式不正确',
            'email.unique'                   => '邮箱地址已存在',
            'password.required'              => '密码不能为空',
            'password.min'                   => '密码长度不能少于6个字符',
            'password_confirmation.required' => '确认密码不能为空',
            'password_confirmation.same'     => '两次输入的密码不一致',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'code'    => 400,
                'message' => $validator->errors()->first(),
                'data'    => null
            ], 400);
        }

        try {
            $user = User::where('email',$request->email)->first();
            if(!$user){
                return response()->json([
                    'code'    => 400,
                    'message' => "用户不存在",
                    'data'    => null
                ], 400);
            }
            $res = app("Service\EmailOtpService")->checkEmailOtp($request->input('email'), EmailOtpLog::TYPE_FORGET, $request->input('code'));
            $user->update([
                'password' => $request->new_password
            ]);

            return response()->json([
                'code'    => 200,
                'message' => '密码重设成功',
                'data'    => [
                    'id'     => $user->id,
                    'email'  => $user->email,
                    'amount' => $user->amount
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code'    => 500,
                'message' => '密码重设失败：' . $e->getMessage(),
                'data'    => null
            ], 500);
        }
    }

    /**
     * 发送注册验证码邮件
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendRegisterEmail(Request $request){
        $validator = Validator::make($request->all(), [
            'email'                 => 'required|email|unique:users',
        ], [
            'email.required'                 => '邮箱地址不能为空',
            'email.email'                    => '邮箱地址格式不正确',
            'email.unique'                   => '邮箱地址已存在',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code'    => 400,
                'message' => $validator->errors()->first(),
                'data'    => null
            ], 400);
        }

        try {
            $res = app("Service\EmailOtpService")->sendEmailOtp($request->input('email'), EmailOtpLog::TYPE_REGISTER);
            //todo 发

            return response()->json([
                'code'    => 200,
                'message' => '发送成功',
                'data'    => [
                    'id'     => $res
                ]
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return response()->json([
                'code'    => 500,
                'message' => '发送失败：' . $e->getMessage(),
                'data'    => null
            ], 500);
        }
    }


    /**
     * 用户注册
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        if(dujiaoka_config_get('is_open_email_otp') == \App\Models\BaseModel::STATUS_OPEN){
            $validator = Validator::make($request->all(), [
                'email'                 => 'required|email|unique:users',
                'code'                 => 'required',
                'password'              => 'required|string|min:6',
                'password_confirmation' => 'required|same:password',
            ], [
                'email.required'                 => '邮箱地址不能为空',
                'code.required'                 => '验证码不能为空',
                'email.email'                    => '邮箱地址格式不正确',
                'email.unique'                   => '邮箱地址已存在',
                'password.required'              => '密码不能为空',
                'password.min'                   => '密码长度不能少于6个字符',
                'password_confirmation.required' => '确认密码不能为空',
                'password_confirmation.same'     => '两次输入的密码不一致',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'email'                 => 'required|email|unique:users',
//                'code'                 => 'required',
                'password'              => 'required|string|min:6',
                'password_confirmation' => 'required|same:password',
            ], [
                'email.required'                 => '邮箱地址不能为空',
//                'code.required'                 => '验证码不能为空',
                'email.email'                    => '邮箱地址格式不正确',
                'email.unique'                   => '邮箱地址已存在',
                'password.required'              => '密码不能为空',
                'password.min'                   => '密码长度不能少于6个字符',
                'password_confirmation.required' => '确认密码不能为空',
                'password_confirmation.same'     => '两次输入的密码不一致',
            ]);
        }


        if ($validator->fails()) {
            return response()->json([
                'code'    => 400,
                'message' => $validator->errors()->first(),
                'data'    => null
            ], 400);
        }

        try {
            if(dujiaoka_config_get('is_open_email_otp') == \App\Models\BaseModel::STATUS_OPEN) {
                $res = app("Service\EmailOtpService")->checkEmailOtp($request->input('email'), EmailOtpLog::TYPE_REGISTER, $request->input('code'));
            }
            $user = User::create([
                'email'      => $request->email,
                'password'   => $request->password,
                'amount'     => 0.00,
                'secret_key' => User::generateSecret(),
            ]);

            return response()->json([
                'code'    => 200,
                'message' => '注册成功',
                'data'    => [
                    'id'     => $user->id,
                    'email'  => $user->email,
                    'amount' => $user->amount
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code'    => 500,
                'message' => '注册失败：' . $e->getMessage(),
                'data'    => null
            ], 500);
        }
    }

    /**
     * 登录
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        Log::error("login:");
        Log::error(password_hash($request->password,PASSWORD_DEFAULT));
        Log::error(json_encode($user));
        if (!$user || !password_verify($request->password, $user->password)) {
            return response()->json([
                'code'    => 401,
                'message' => '用户名或密码错误',
                'data'    => null
            ], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'code'    => 200,
            'message' => '登录成功',
            'data'    => [
                'id'     => $user->id,
                'email'  => $user->email,
                'amount' => $user->amount,
                'token'  => $token
            ]
        ]);
    }


    /**
     * 用户信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function info(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'code'    => 200,
            'message' => '获取成功',
            'data'    => [
                'id'         => $user->id,
                'email'      => $user->email,
                'amount'     => $user->amount,
                'secret_key' => $user->secret_key,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]
        ]);
    }


    /**
     * 用户余额
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function amount(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'code'    => 200,
            'message' => '获取成功',
            'data'    => [
                'amount' => $user->amount,
            ]
        ]);
    }


    /**
     * 修改密码
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'old_password'              => 'required|string',
            'new_password'              => 'required|string|min:6',
            'new_password_confirmation' => 'required|same:new_password',
        ], [
            'old_password.required'              => '原密码不能为空',
            'new_password.required'              => '新密码不能为空',
            'new_password.min'                   => '新密码长度不能少于6个字符',
            'new_password_confirmation.required' => '确认新密码不能为空',
            'new_password_confirmation.same'     => '两次输入的新密码不一致',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code'    => 400,
                'message' => $validator->errors()->first(),
                'data'    => null
            ], 400);
        }

        if (!password_verify($request->old_password, $user->password)) {
            return response()->json([
                'code'    => 400,
                'message' => '原密码错误',
                'data'    => null
            ], 400);
        }

        try {
            $user->update([
                'password' => $request->new_password
            ]);

            return response()->json([
                'code'    => 200,
                'message' => '密码修改成功',
                'data'    => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code'    => 500,
                'message' => '密码修改失败：' . $e->getMessage(),
                'data'    => null
            ], 500);
        }
    }


    /**
     * 用户注销
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'code'    => 200,
            'message' => '登出成功',
            'data'    => null
        ]);
    }
}
