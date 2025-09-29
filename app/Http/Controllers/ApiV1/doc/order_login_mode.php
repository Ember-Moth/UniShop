<?php

/**
 * @OA\Schema(
 *     schema="UserCreateOrderRequest",
 *     type="object",
 *     required={"gid","email","buy_amount"},
 *     @OA\Property(property="gid", type="integer", example=1, description="商品ID"),
 *     @OA\Property(property="email", type="string", format="email", example="testuser@abc.com", description="邮箱地址"),
 *     @OA\Property(property="payway", type="integer", example=1, description="支付方式编号"),
 *     @OA\Property(property="buy_amount", type="integer", example=1, description="购买数量")
 * )
 */

/**
 * @OA\Schema(
 *     schema="UserCreateOrderData",
 *     type="object",
 *     @OA\Property(property="id", type="string", example="ABC123DEF456GHI7", description="订单ID"),
 *     @OA\Property(property="order_sn", type="string", example="ABC123DEF456GHI7", description="订单号")
 * )
 */

/**
 * @OA\Schema(
 *     schema="UserOrderDetailRequest",
 *     type="object",
 *     required={"id"},
 *     @OA\Property(property="id", type="integer", example=11, description="订单ID")
 * )
 */

/**
 * @OA\Schema(
 *     schema="UserOrderDetailData",
 *     type="object",
 *     @OA\Property(
 *         property="order",
 *         ref="#/components/schemas/Order"
 *     )
 * )
 */

/**
 * @OA\Schema(
 *     schema="UserCreatePaymentRequest",
 *     type="object",
 *     required={"order_sn","payment_type"},
 *     @OA\Property(property="order_sn", type="string", example="ABC123DEF456GHI7", description="订单号"),
 *     @OA\Property(property="payment_type", type="string", example="alipay", description="支付方式类型")
 * )
 */

/**
 * @OA\Schema(
 *     schema="UserCreatePaymentData",
 *     type="object",
 *     @OA\Property(property="payment_url", type="string", example="https://pay.example.com/pay/123456", description="支付链接"),
 *     @OA\Property(property="qr_code", type="string", example="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAA...", description="支付二维码")
 * )
 */

/**
 * 创建订单
 *
 * @OA\Post(
 *     path="/api/v1/user/create_order",
 *     operationId="userCreateOrder",
 *     tags={"订单-登录模式"},
 *     summary="创建订单",
 *     description="创建新的商品订单（登录状态）",
 *     security={{"BearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/UserCreateOrderRequest"),
 *             @OA\Examples(
 *                 example="example1",
 *                 summary="创建订单示例",
 *                 value={
 *                     "gid": 1,
 *                     "email": "testuser@abc.com",
 *                     "payway": 1,
 *                     "buy_amount": 1
 *                 }
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="创建成功",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(ref="#/components/schemas/BaseResponse"),
 *                 @OA\Schema(
 *                     type="object",
 *                     @OA\Property(
 *                         property="data",
 *                         ref="#/components/schemas/UserCreateOrderData"
 *                     ),
 *                     required={"data"}
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="请求参数错误",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="未授权",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="服务器内部错误",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     )
 * )
 */


/**
 * 获取用户订单列表
 *
 * @OA\Get(
 *     path="/api/v1/user/order/list",
 *     operationId="getUserOrderList",
 *     tags={"订单-登录模式"},
 *     summary="获取用户订单列表",
 *     description="获取当前用户的订单列表",
 *     security={{"BearerAuth": {}}},
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="页码",
 *         required=false,
 *         @OA\Schema(type="integer", default=1)
 *     ),
 *     @OA\Parameter(
 *         name="per_page",
 *         in="query",
 *         description="每页数量",
 *         required=false,
 *         @OA\Schema(type="integer", default=15)
 *     ),
 *     @OA\Parameter(
 *         name="keyword",
 *         in="query",
 *         description="搜索关键词",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="获取成功",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(ref="#/components/schemas/BaseResponse"),
 *                 @OA\Schema(
 *                     type="object",
 *                     @OA\Property(
 *                         property="data",
 *                         type="array",
 *                         @OA\Items(ref="#/components/schemas/Order")
 *                     ),
 *                     @OA\Property(
 *                         property="pagination",
 *                         type="object",
 *                         @OA\Property(property="current_page", type="integer", example=1),
 *                         @OA\Property(property="per_page", type="integer", example=15),
 *                         @OA\Property(property="total", type="integer", example=100),
 *                         @OA\Property(property="last_page", type="integer", example=7)
 *                     ),
 *                     required={"data", "pagination"}
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="未授权",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="服务器内部错误",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     )
 * )
 */


/**
 * 通过订单编号查询订单
 *
 * @OA\Get(
 *     path="/api/v1/user/order/{id}",
 *     operationId="userOrderDetail",
 *     tags={"订单-登录模式"},
 *     summary="通过订单编号查询订单",
 *     description="通过订单编号查询单个订单的详细信息",
 *     security={{"BearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="订单ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=11)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="查询成功",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(ref="#/components/schemas/BaseResponse"),
 *                 @OA\Schema(
 *                     type="object",
 *                     @OA\Property(
 *                         property="data",
 *                         ref="#/components/schemas/UserOrderDetailData"
 *                     ),
 *                     required={"data"}
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="请求参数错误",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="未授权",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="订单不存在",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="服务器内部错误",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     )
 * )
 */

