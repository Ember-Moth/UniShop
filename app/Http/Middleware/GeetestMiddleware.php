<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Germey\Geetest\Geetest;

class GeetestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 检查是否开启极验验证
        if (!$this->isGeetestEnabled()) {
            return $next($request);
        }

        // 获取极验验证参数
        $geetestChallenge = $request->input('geetest_challenge');
        $geetestValidate = $request->input('geetest_validate');
        $geetestSeccode = $request->input('geetest_seccode');

        // 检查是否提供了极验验证参数
        if (!$geetestChallenge || !$geetestValidate || !$geetestSeccode) {
            return response()->json([
                'code' => 400,
                'message' => '请完成极验验证',
                'data' => null
            ], 400);
        }

        // 验证极验验证结果
        if (!$this->validateGeetest($request)) {
            return response()->json([
                'code' => 400,
                'message' => '极验验证失败，请重试',
                'data' => null
            ], 400);
        }

        return $next($request);
    }

    /**
     * 检查是否开启极验验证
     *
     * @return bool
     */
    private function isGeetestEnabled()
    {
        // 从缓存或配置中获取极验验证开关状态
        $isEnabled = Cache::get('system-setting.is_open_geetest', false);
        
        // 如果缓存中没有，尝试从配置中获取
        if ($isEnabled === false) {
            $isEnabled = config('geetest.enabled', false);
        }

        return (bool) $isEnabled;
    }

    /**
     * 验证极验验证结果
     *
     * @param Request $request
     * @return bool
     */
    private function validateGeetest(Request $request)
    {
        try {
            $data = [
                'user_id' => $request->ip(),
                'client_type' => 'web',
                'ip_address' => $request->ip()
            ];

            $geetestChallenge = $request->input('geetest_challenge');
            $geetestValidate = $request->input('geetest_validate');
            $geetestSeccode = $request->input('geetest_seccode');

            // 使用极验SDK验证
            $result = Geetest::successValidate($geetestChallenge, $geetestValidate, $geetestSeccode, $data);

            if ($result) {
                // 验证成功，记录日志
                Log::info('极验验证成功', [
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'action' => $request->path()
                ]);

                // 防止重复使用验证结果
                $this->markGeetestUsed($geetestChallenge, $geetestValidate, $geetestSeccode);

                return true;
            }

            // 验证失败，记录日志
            Log::warning('极验验证失败', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'action' => $request->path(),
                'challenge' => $geetestChallenge,
                'validate' => $geetestValidate,
                'seccode' => $geetestSeccode
            ]);

            return false;

        } catch (\Exception $e) {
            // 验证异常，记录日志
            Log::error('极验验证异常', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'action' => $request->path(),
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * 标记极验验证结果已使用，防止重复使用
     *
     * @param string $challenge
     * @param string $validate
     * @param string $seccode
     * @return void
     */
    private function markGeetestUsed($challenge, $validate, $seccode)
    {
        $key = "geetest_used:{$challenge}:{$validate}:{$seccode}";
        Cache::put($key, true, 300); // 5分钟内不能重复使用
    }

    /**
     * 检查极验验证结果是否已被使用
     *
     * @param string $challenge
     * @param string $validate
     * @param string $seccode
     * @return bool
     */
    private function isGeetestUsed($challenge, $validate, $seccode)
    {
        $key = "geetest_used:{$challenge}:{$validate}:{$seccode}";
        return Cache::has($key);
    }
}
