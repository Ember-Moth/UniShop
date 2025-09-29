<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class ApiAuth
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
        $token = $request->header('Authorization');
        
        if (!$token) {
            return response()->json([
                'code' => 401,
                'message' => '未提供认证令牌',
                'data' => null
            ], 401);
        }

        // 移除Bearer前缀
        $token = str_replace('Bearer ', '', $token);

        // 这里简化处理，实际项目中应该验证token的有效性
        // 可以通过数据库存储token，或者使用JWT等方式
        $user = User::where('secret', $token)->first();

        if (!$user) {
            return response()->json([
                'code' => 401,
                'message' => '认证令牌无效',
                'data' => null
            ], 401);
        }

        // 将用户信息添加到请求中
        $request->merge(['user' => $user]);
        
        return $next($request);
    }
}
