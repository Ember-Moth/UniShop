<?php

/**
 * @OA\Schema(
 *     schema="PaymentOrder",
 *     @OA\Property(property="trade_no", type="string", example="ORDER_1704067200", description="订单号"),
 *     @OA\Property(property="total_amount", type="integer", example=10000, description="订单金额（分）"),
 *     @OA\Property(property="user_id", type="integer", example=1, description="用户ID"),
 *     @OA\Property(property="payment_type", type="string", example="alipay_f2f", description="支付方式"),
 *     @OA\Property(property="status", type="string", example="pending", description="订单状态"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T00:00:00.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T00:00:00.000000Z")
 * )
 *
 * @OA\Schema(
 *     schema="CreatePaymentRequest",
 *     type="object",
 *     required={"order_sn"},
 *     @OA\Property(property="order_sn", type="string", example="9EXSMLNZQ511YLZZ", description="订单号"),
 *     @OA\Property(property="payway", type="integer", example=1, description="支付方式编号")
 * )
 *
 * @OA\Schema(
 *     schema="PaymentResponse",
 *     type="object",
 *     @OA\Property(property="order_sn", type="string", example="ABC123DEF456GHI7", description="订单号"),
 *     @OA\Property(property="email", type="string", format="email", example="user@example.com", description="邮箱"),
 *     @OA\Property(property="title", type="string", example="王者荣耀点券 x 1", description="订单标题"),
 *     @OA\Property(property="buy_amount", type="integer", example=1, description="购买数量"),
 *     @OA\Property(property="payment", type="string", example="支付宝", description="支付方式名称"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T00:00:00.000000Z", description="创建时间"),
 *     @OA\Property(property="type_txt", type="string", example="自动发货", description="订单类型文本")
 * )
 *
 * @OA\Schema(
 *     schema="PaymentMethod",
 *     type="object",
 *     @OA\Property(property="id", type="string", example="alipay_f2f", description="支付方式标识"),
 *     @OA\Property(property="name", type="string", example="支付宝当面付", description="支付方式名称")
 * )
 *
 * @OA\Schema(
 *     schema="PaymentNotifyRequest",
 *     type="object",
 *     @OA\Property(property="trade_no", type="string", example="ORDER_1704067200", description="订单号"),
 *     @OA\Property(property="callback_no", type="string", example="PAY_1704067200", description="支付平台交易号"),
 *     @OA\Property(property="amount", type="string", example="100.00", description="支付金额"),
 *     @OA\Property(property="status", type="string", example="success", description="支付状态"),
 *     @OA\Property(property="sign", type="string", example="signature", description="签名")
 * )
 *
 * @OA\Schema(
 *     schema="PaymentMethodsData",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/PaymentMethod")
 * )
 */

/**
 * 获取支持的支付方式列表
 *
 * @OA\Get(
 *     path="/api/v1/payment/methods",
 *     operationId="getPaymentMethods",
 *     tags={"支付模块"},
 *     summary="获取支持的支付方式列表",
 *     description="获取系统支持的所有支付方式及其详细信息",
 *     @OA\Response(
 *         response=200,
 *         description="获取成功",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="code", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="success"),
 *             @OA\Property(
 *                 property="data",
 *                 ref="#/components/schemas/PaymentMethodsData"
 *             ),
 *             required={"code", "message", "data"}
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="服务器内部错误",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     )
 * )
 */

/**
 * 创建支付订单
 *
 * @OA\Post(
 *     path="/api/v1/payment/create",
 *     operationId="createPayment",
 *     tags={"支付模块"},
 *     summary="创建支付订单(游客模式)",
 *     description="创建新的支付订单并返回支付信息",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/CreatePaymentRequest"),
 *             example={"order_sn": "9EXSMLNZQ511YLZZ"}
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="创建成功",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="code", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="success"),
 *             @OA\Property(
 *                 property="data",
 *                 ref="#/components/schemas/PaymentResponse"
 *             ),
 *             required={"code", "message", "data"}
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="参数错误",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="支付创建失败",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     )
 * )
 */

/**
 * 创建支付订单
 *
 * @OA\Post(
 *     path="/api/v1/payment/user/create",
 *     operationId="userCreatePayment",
 *     tags={"支付模块"},
 *     summary="创建支付订单(登录状态)",
 *     description="创建新的支付订单并返回支付信息",
 *     security={{"BearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/CreatePaymentRequest"),
 *             example={"order_sn": "9EXSMLNZQ511YLZZ"}
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="创建成功",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="code", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="success"),
 *             @OA\Property(
 *                 property="data",
 *                 ref="#/components/schemas/PaymentResponse"
 *             ),
 *             required={"code", "message", "data"}
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="参数错误",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="未授权",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="支付创建失败",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     )
 * )
 */
