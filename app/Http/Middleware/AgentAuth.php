<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AgentAuth
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
        $params = $request->all();
        Log::info("agent auth");
        Log::info(json_encode($params));
        if(!isset($params['agent_id']) ||!isset($params['sign']))
            return response()->json([
                'code' => 401,
                'message' => '认证令牌无效',
                'data' => null
            ], 401);

        $param_sign = $params['sign'];
        $user = User::where('id', $params['agent_id'])->first();
        Log::info($user);
        $sign = generate_signature($params, $user->secret_key);
        Log::info($sign);
        if ($param_sign != $sign) {
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
