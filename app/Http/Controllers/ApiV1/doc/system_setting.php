<?php

/**
 * @OA\Schema(
 *     schema="SystemSettingRequest",
 *     type="object",
 *     required={"key"},
 *     @OA\Property(property="key", type="string", example="is_open_anti_red", description="配置键名")
 * )
 */

/**
 * @OA\Schema(
 *     schema="SystemSettingData",
 *     type="object",
 *     @OA\Property(property="is_open_anti_red", type="integer", example=1, description="配置值")
 * )
 */

/**
 * @OA\Schema(
 *     schema="SystemSettingsRequest",
 *     type="object",
 *     required={"keys"},
 *     @OA\Property(
 *         property="keys",
 *         type="array",
 *         @OA\Items(type="string"),
 *         description="配置键名数组",
 *         example={"is_open_anti_red", "site_name"}
 *     )
 * )
 */

/**
 * @OA\Schema(
 *     schema="SystemSettingsData",
 *     type="object",
 *     @OA\Property(property="is_open_anti_red", type="integer", example=1, description="是否开启微信/QQ防红"),
 *     @OA\Property(property="site_name", type="string", example="My Site", description="网站名称")
 * )
 */

/**
 * @OA\Schema(
 *     schema="BaseSystemSettingsData",
 *     type="object",
 *     @OA\Property(property="title", type="string", example="网站标题", description="网站标题"),
 *     @OA\Property(property="img_logo", type="string", example="https://test.abc/upload/abc.png", description="图片LOGO"),
 *     @OA\Property(property="text_logo", type="string", example="LOGO", description="文字LOGO"),
 *     @OA\Property(property="keywords", type="string", example="衣服,帽子", description="网站关键词"),
 *     @OA\Property(property="description", type="string", example="一个很特别的网站", description="网站描述"),
 *     @OA\Property(property="template", type="string", example="template1", description="站点模板"),
 *     @OA\Property(property="language", type="string", example="zh-CN", description="站点语言"),
 *     @OA\Property(property="manage_email", type="string", example="admin@admin.cn", description="管理员邮箱"),
 *     @OA\Property(property="order_expire_time", type="integer", example=5, description="订单过期时间(分钟)"),
 *     @OA\Property(property="is_open_anti_red", type="integer", example=0, description="是否开启微信/QQ防红"),
 *     @OA\Property(property="is_open_img_code", type="integer", example=1, description="是否开启图形验证码"),
 *     @OA\Property(property="is_open_search_pwd", type="integer", example=0, description="是否开启查询密码"),
 *     @OA\Property(property="is_open_google_translate", type="integer", example=0, description="是否开启google翻译"),
 *     @OA\Property(property="is_open_email_otp", type="integer", example=1, description="是否开启邮箱验证码"),
 *     @OA\Property(property="notice", type="string", example="最新活动公告", description="站点公告"),
 *     @OA\Property(property="footer_code", type="string", example="", description="页脚自定义代码")
 * )
 */

/**
 * 获取单个系统配置
 *
 * @OA\Post(
 *     path="/api/v1/system-setting",
 *     operationId="getSystemSettingByKey",
 *     tags={"系统配置"},
 *     summary="获取单个系统配置",
 *     description="根据键名获取系统配置",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/SystemSettingRequest"),
 *             @OA\Examples(
 *                 example="example1",
 *                 summary="获取单个配置示例",
 *                 value={"key": "is_open_anti_red"}
 *             )
 *         )
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
 *                         ref="#/components/schemas/SystemSettingData"
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
 * 获取多个系统配置
 *
 * @OA\Post(
 *     path="/api/v1/system-settings",
 *     operationId="getSystemSettingsByKeys",
 *     tags={"系统配置"},
 *     summary="获取多个系统配置",
 *     description="根据键名组获取多个系统配置",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/SystemSettingsRequest"),
 *             @OA\Examples(
 *                 example="example1",
 *                 summary="获取多个配置示例",
 *                 value={"keys": {"is_open_anti_red", "site_name"}}
 *             )
 *         )
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
 *                         ref="#/components/schemas/SystemSettingsData"
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
 * 获取所有基本系统配置
 *
 * @OA\Post(
 *     path="/api/v1/base-system-settings",
 *     operationId="getBaseSystemSettings",
 *     tags={"系统配置"},
 *     summary="获取所有基本系统配置",
 *     description="获取系统的基本配置信息，包括网站标题、LOGO、关键词等",
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
 *                         ref="#/components/schemas/BaseSystemSettingsData"
 *                     ),
 *                     required={"data"}
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="服务器内部错误",
 *         @OA\JsonContent(ref="#/components/schemas/BaseResponse")
 *     )
 * )
 */