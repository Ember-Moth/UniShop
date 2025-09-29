<?php
/**
 * @OA\Tag(
 *     name="Balance",
 *     description="用户余额相关接口"
 * )
 */

/**
 * @OA\Get(
 *     path="/api/v1/user/balance",
 *     summary="获取用户余额",
 *     tags={"Balance"},
 *     security={{"bearer":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="成功",
 *         @OA\JsonContent(
 *             @OA\Property(property="code", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="成功"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="balance", type="number", format="float", example=1000.50, description="用户余额")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=401, description="未授权")
 * )
 */

/**
 * @OA\Post(
 *     path="/api/v1/user/balance/recharge",
 *     summary="创建充值订单",
 *     tags={"Balance"},
 *     security={{"bearer":{}}},
 *     @OA\RequestBody(
 *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="amount", type="number", format="float", example=100.00, description="充值金额"),
     *             @OA\Property(property="pay_id", type="integer", example=1, description="支付方式ID")
     *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="成功",
 *         @OA\JsonContent(
 *             @OA\Property(property="code", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="成功"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="order_sn", type="string", example="RO202509171700001234", description="充值订单号"),
     *                 @OA\Property(property="amount", type="string", example="100.00", description="充值金额"),
     *                 @OA\Property(property="status", type="integer", example=1, description="状态"),
     *                 @OA\Property(property="payment_data", type="object", description="支付数据"),
     *                 @OA\Property(property="expired_at", type="string", format="datetime", example="2025-09-17 17:30:00", description="过期时间")
     *             )
 *         )
 *     ),
 *     @OA\Response(response=422, description="参数验证失败"),
 *     @OA\Response(response=401, description="未授权")
 * )
 */
/**
 * @OA\Get(
 *     path="/api/v1/user/balance/recharge-orders",
 *     summary="获取充值订单列表",
 *     tags={"Balance"},
 *     security={{"bearer":{}}},
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="页码",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Parameter(
 *         name="page_size",
 *         in="query",
 *         description="每页数量",
 *         @OA\Schema(type="integer", example=20)
 *     ),
 *     @OA\Parameter(
 *         name="status",
 *         in="query",
 *         description="订单状态",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="成功",
 *         @OA\JsonContent(
 *             @OA\Property(property="code", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="成功"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="current_page", type="integer", example=1),
 *                 @OA\Property(property="per_page", type="integer", example=20),
 *                 @OA\Property(property="total", type="integer", example=100),
 *                 @OA\Property(
 *                     property="data",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="order_sn", type="string", example="RO202509171700001234"),
 *                         @OA\Property(property="amount", type="number", format="float", example=100.00),
 *                         @OA\Property(property="actual_amount", type="number", format="float", example=100.00),
 *                         @OA\Property(property="bonus_amount", type="number", format="float", example=0.00),
 *                         @OA\Property(property="status", type="integer", example=1),
 *                         @OA\Property(property="status_text", type="string", example="待支付"),
 *                         @OA\Property(property="payment_method", type="string", example="alipay"),
 *                         @OA\Property(property="created_at", type="string", format="datetime", example="2025-09-17 17:00:00"),
 *                         @OA\Property(property="expired_at", type="string", format="datetime", example="2025-09-17 17:30:00")
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(response=401, description="未授权")
 * )
 */

/**
 * @OA\Get(
 *     path="/api/v1/user/balance/logs",
 *     summary="获取余额变动记录",
 *     tags={"Balance"},
 *     security={{"bearer":{}}},
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="页码",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Parameter(
 *         name="page_size",
 *         in="query",
 *         description="每页数量",
 *         @OA\Schema(type="integer", example=20)
 *     ),
 *     @OA\Parameter(
 *         name="type",
 *         in="query",
 *         description="变动类型",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="成功",
 *         @OA\JsonContent(
 *             @OA\Property(property="code", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="成功"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="current_page", type="integer", example=1),
 *                 @OA\Property(property="per_page", type="integer", example=20),
 *                 @OA\Property(property="total", type="integer", example=100),
 *                 @OA\Property(
 *                     property="data",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="log_sn", type="string", example="BL202509171700001234"),
 *                         @OA\Property(property="type", type="integer", example=1),
 *                         @OA\Property(property="type_text", type="string", example="充值"),
 *                         @OA\Property(property="amount", type="number", format="float", example=100.00),
 *                         @OA\Property(property="balance_before", type="number", format="float", example=500.00),
 *                         @OA\Property(property="balance_after", type="number", format="float", example=600.00),
 *                         @OA\Property(property="title", type="string", example="余额充值"),
 *                         @OA\Property(property="description", type="string", example="充值订单：RO202509171700001234"),
 *                         @OA\Property(property="created_at", type="string", format="datetime", example="2025-09-17 17:00:00")
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(response=401, description="未授权")
 * )
 */
