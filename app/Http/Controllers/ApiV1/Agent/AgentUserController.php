<?php

namespace App\Http\Controllers\ApiV1\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgentUserController extends Controller
{
    public function getAgentUserBalance(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => [
                'agent_id' => $user->id,
                'balance' => $user->amount
            ]
        ]);
    }
}