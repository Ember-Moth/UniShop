<?php
/**
 * @OA\Tag(
 *     name="user",
 *     description="用户注册、登录、信息管理相关接口"
 * )
 *
 * @OA\Schema(
 *     schema="BaseResponse",
 *     type="object",
 *     description="通用响应结构基类",
 *     @OA\Property(property="code", type="integer", description="状态码"),
 *     @OA\Property(property="message", type="string", description="响应信息"),
 *     @OA\Property(property="data", description="响应数据", nullable=true),
 *     required={"code", "message"}
 * )
 *
 * @OA\Schema(
 *     schema="User",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="email", type="string", example="testuser@example.com"),
 *     @OA\Property(property="amount", type="string", example="100.00"),
 *     @OA\Property(property="secret_key", type="string", example="user_secret_key_123456"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T00:00:00.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T00:00:00.000000Z")
 * )
 *
 * @OA\Schema(
 *     schema="UserAmount",
 *     @OA\Property(property="amount", type="string", example="100.00")
 * )
 *
 * @OA\Schema(
 *     schema="RegisterOtpRequest",
 *     type="object",
 *     required={"email"},
 *     @OA\Property(property="email", type="string", format="email", description="邮箱地址", example="user@example.com")
 * )
 *
 * @OA\Schema(
 *     schema="RegisterOtpData",
 *     type="object",
 *     @OA\Property(property="id", type="string", description="验证码ID", example="otp_123456")
 * )
 *
 * @OA\Schema(
 *     schema="UserRegisterRequest",
 *     @OA\Property(property="email", type="string", example="testuser@example.com", description="邮箱地址"),
 *     @OA\Property(property="password", type="string", example="123456", description="密码"),
 *     @OA\Property(property="password_confirmation", type="string", example="123456", description="确认密码")
 * )
 *
 * @OA\Schema(
 *     schema="UserLoginRequest",
 *     @OA\Property(property="email", type="string", example="testuser@example.com", description="邮箱地址"),
 *     @OA\Property(property="password", type="string", example="123456", description="密码"),
 * )
 *
 * @OA\Schema(
 *     schema="UserLoginResponse",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="email", type="string", example="testuser@example.com"),
 *     @OA\Property(property="amount", type="string", example="100.00"),
 *     @OA\Property(property="secret_key", type="string", example="user_secret_key_123456"),
 *     @OA\Property(property="token", type="string", example="3_zyrbE2MfPoZMnxQfZVZgOAojr6fTWOHyuSnLY0eu")
 * )
 *
 * @OA\Schema(
 *     schema="UserChangePasswordRequest",
 *     @OA\Property(property="old_password", type="string", example="123456", description="原密码"),
 *     @OA\Property(property="new_password", type="string", example="newpassword", description="新密码"),
 *     @OA\Property(property="new_password_confirmation", type="string", example="newpassword", description="确认新密码")
 * )
 *
 * @OA\Schema(
 *     schema="ForgetPasswordRequest",
 *     type="object",
 *     required={"email"},
 *     @OA\Property(property="email", type="string", format="email", description="邮箱地址", example="user@example.com")
 * )
 *
 * @OA\Schema(
 *     schema="ResetPasswordRequest",
 *     type="object",
 *     required={"email", "code", "password", "password_confirmation"},
 *     @OA\Property(property="email", type="string", format="email", description="邮箱地址", example="user@example.com"),
 *     @OA\Property(property="code", type="string", description="邮箱验证码", example="123456"),
 *     @OA\Property(property="password", type="string", description="新密码", example="123456"),
 *     @OA\Property(property="password_confirmation", type="string", description="确认新密码", example="123456")
 * )
 *
 */

/**
 * @OA\Post(
 *     path="/api/v1/user/otp/forget-password",
 *     summary="发送重置密码邮件",
 *     tags={"用户管理"},
 *     description="向指定邮箱发送重置密码验证码",
 *     operationId="sendForgetPasswordEmail",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/ForgetPasswordRequest"),
 *             @OA\Examples(
 *                 example="example1",
 *                 summary="发送重置密码邮件示例",
 *                 value={"email": "user@example.com"}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="发送成功",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="请求参数错误",
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
 * @OA\Post(
 *     path="/api/v1/user/reset-password",
 *     summary="重置密码",
 *     tags={"用户管理"},
 *     description="通过邮箱验证码重置用户密码",
 *     operationId="resetPassword",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/ResetPasswordRequest"),
 *             @OA\Examples(
 *                 example="example1",
 *                 summary="重置密码示例",
 *                 value={
 *                     "email": "user@example.com",
 *                     "code": "123456",
 *                     "password": "newpassword",
 *                     "password_confirmation": "newpassword"
 *                 }
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="重置成功",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="请求参数错误",
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
 * @OA\Post(
 *     path="/api/v1/user/otp/register",
 *     tags={"用户管理"},
 *     summary="发送注册验证码邮件",
 *     description="向指定邮箱发送注册验证码，用于用户注册时的邮箱验证",
 *     operationId="sendRegisterEmail",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/RegisterOtpRequest"),
 *             @OA\Examples(
 *                 example="example1",
 *                 summary="发送注册验证码示例",
 *                 value={"email": "user@example.com"}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="发送成功",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(ref="#/components/schemas/BaseResponse"),
 *                 @OA\Schema(
 *                     type="object",
 *                     @OA\Property(
 *                         property="data",
 *                         ref="#/components/schemas/RegisterOtpData"
 *                     ),
 *                     required={"data"}
 *                 )
 *             },
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="请求参数错误",
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
 * 用户注册
 *
 * @OA\Post(
 *     path="/api/v1/user/register",
 *     operationId="userRegister",
 *     tags={"用户管理"},
 *     summary="用户注册",
 *     description="创建新用户账号",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/UserRegisterRequest"),
 *             @OA\Examples(
 *                 example="example1",
 *                 summary="用户注册示例",
 *                 value={
 *                     "email": "testuser@example.com",
 *                     "password": "123456",
 *                     "password_confirmation": "123456",
 *                     "code": "123456"
 *                 }
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="注册成功",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(ref="#/components/schemas/BaseResponse"),
 *                 @OA\Schema(
 *                     type="object",
 *                     @OA\Property(
 *                         property="data",
 *                         ref="#/components/schemas/User"
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
 *         response=500,
 *         description="服务器内部错误",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     )
 * )
 */

/**
 * 用户登录
 *
 * @OA\Post(
 *     path="/api/v1/user/login",
 *     operationId="userLogin",
 *     tags={"用户管理"},
 *     summary="用户登录",
 *     description="用户登录获取访问令牌",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/UserLoginRequest"),
 *             @OA\Examples(
 *                 example="example1",
 *                 summary="用户登录示例",
 *                 value={
 *                     "email": "testuser@example.com",
 *                     "password": "123456"
 *                 }
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="登录成功",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(ref="#/components/schemas/BaseResponse"),
 *                 @OA\Schema(
 *                     type="object",
 *                     @OA\Property(
 *                         property="data",
 *                         ref="#/components/schemas/UserLoginResponse"
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
 *         description="用户名或密码错误",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     )
 * )
 */

/**
 * 获取用户信息
 *
 * @OA\Get(
 *     path="/api/v1/user/info",
 *     operationId="userInfo",
 *     tags={"用户管理"},
 *     summary="获取用户信息",
 *     description="获取当前登录用户的详细信息",
 *     security={{"BearerAuth": {}}},
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
 *                         ref="#/components/schemas/User"
 *                     ),
 *                     required={"data"}
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="未认证或认证失败",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     )
 * )
 */

/**
 * 获取用户余额
 *
 * @OA\Get(
 *     path="/api/v1/user/amount",
 *     operationId="userAmount",
 *     tags={"用户管理"},
 *     summary="获取用户余额",
 *     description="获取当前登录用户的用户余额",
 *     security={{"BearerAuth": {}}},
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
 *                         ref="#/components/schemas/UserAmount"
 *                     ),
 *                     required={"data"}
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="未认证或认证失败",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     )
 * )
 */

/**
 * 修改密码
 *
 * @OA\Post(
 *     path="/api/v1/user/change-password",
 *     operationId="userChangePassword",
 *     tags={"用户管理"},
 *     summary="修改密码",
 *     description="修改当前登录用户的密码",
 *     security={{"BearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/UserChangePasswordRequest"),
 *             @OA\Examples(
 *                 example="example1",
 *                 summary="修改密码示例",
 *                 value={
 *                     "old_password": "123456",
 *                     "new_password": "newpassword",
 *                     "new_password_confirmation": "newpassword"
 *                 }
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="密码修改成功",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="请求参数错误或原密码错误",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="未认证或认证失败",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="密码修改失败",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     )
 * )
 */

/**
 * 用户登出
 *
 * @OA\Post(
 *     path="/api/v1/user/logout",
 *     operationId="userLogout",
 *     tags={"用户管理"},
 *     summary="用户登出",
 *     description="用户登出，清除认证状态",
 *     security={{"BearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="登出成功",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="未认证或认证失败",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     )
 * )
 */