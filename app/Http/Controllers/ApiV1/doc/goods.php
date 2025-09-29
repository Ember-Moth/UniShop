<?php

/**
 * @OA\Tag(
 *     name="goods",
 *     description="商品信息查询相关接口"
 * )
 *
 * @OA\Schema(
 *     schema="Goods",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="gd_name", type="string", example="测试商品"),
 *     @OA\Property(property="gd_description", type="string", example="商品描述"),
 *     @OA\Property(property="gd_keywords", type="string", example="关键词"),
 *     @OA\Property(property="picture", type="string", example="https://example.com/image.jpg"),
 *     @OA\Property(property="retail_price", type="string", example="100.00"),
 *     @OA\Property(property="actual_price", type="string", example="80.00"),
 *     @OA\Property(property="in_stock", type="integer", example=100),
 *     @OA\Property(property="sales_volume", type="integer", example=50),
 *     @OA\Property(property="type", type="integer", example=1, description="1:自动发货 2:人工处理"),
 *     @OA\Property(property="type_text", type="string", example="自动发货"),
 *     @OA\Property(property="is_open", type="integer", example=1, description="1:开启 0:关闭"),
 *     @OA\Property(property="is_open_text", type="string", example="开启"),
 *     @OA\Property(property="buy_limit_num", type="integer", example=10),
 *     @OA\Property(property="buy_prompt", type="string", example="购买提示"),
 *     @OA\Property(property="description", type="string", example="商品详细描述"),
 *     @OA\Property(property="ord", type="integer", example=1),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T00:00:00.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T00:00:00.000000Z"),
 *     @OA\Property(
 *         property="group",
 *         type="object",
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="gp_name", type="string", example="商品分类")
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="GoodsListResponse",
 *     @OA\Property(property="code", type="integer", example=200),
 *     @OA\Property(property="message", type="string", example="获取成功"),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Goods")
 *     ),
 *     @OA\Property(
 *          property="pagination",
 *          ref="#/components/schemas/PaginationResponse"
 *      )
 * )
 *
 * @OA\Schema(
 *     schema="GoodsDetailResponse",
 *     @OA\Property(property="code", type="integer", example=200),
 *     @OA\Property(property="message", type="string", example="获取成功"),
 *     @OA\Property(
 *         property="data",
 *         ref="#/components/schemas/Goods"
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="GoodsListData",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/Goods")
 * )
 *
 * @OA\Schema(
 *     schema="HotGoodsListData",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/Goods")
 * )
 *
 * @OA\Schema(
 *     schema="GoodsGroup",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="gp_name", type="string", example="商品分类"),
 *     @OA\Property(property="ord", type="integer", example=1),
 *     @OA\Property(property="is_open", type="integer", example=1, description="1:开启 0:关闭"),
 *     @OA\Property(property="goods_count", type="integer", example=15, description="该分类下的商品数量"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T00:00:00.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T00:00:00.000000Z")
 * )
 *
 * @OA\Schema(
 *     schema="CategoryListData",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/GoodsGroup")
 * )
 */

/**
 * 获取所有商品列表
 *
 * @OA\Get(
 *     path="/api/v1/goods/list",
 *     operationId="getGoodsList",
 *     tags={"商品管理"},
 *     summary="获取商品列表",
 *     description="获取所有已开启的商品信息列表",
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
 *         name="group_id",
 *         in="query",
 *         description="商品分类ID",
 *         required=false,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="type",
 *         in="query",
 *         description="商品类型 1:自动发货 2:人工处理",
 *         required=false,
 *         @OA\Schema(type="integer")
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
 *             @OA\Property(property="code", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="获取成功"),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(ref="#/components/schemas/Goods")
 *             ),
 *             @OA\Property(
 *                 property="pagination",
 *                 type="object",
 *                 @OA\Property(property="current_page", type="integer", example=1),
 *                 @OA\Property(property="per_page", type="integer", example=15),
 *                 @OA\Property(property="total", type="integer", example=100),
 *                 @OA\Property(property="last_page", type="integer", example=7)
 *             )
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
 * 获取商品详情
 *
 * @OA\Get(
 *     path="/api/v1/goods/{id}",
 *     operationId="getGoodsDetail",
 *     tags={"商品管理"},
 *     summary="获取商品详情",
 *     description="根据商品ID获取商品详细信息",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="商品ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
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
 *                         ref="#/components/schemas/Goods"
 *                     ),
 *                     required={"data"}
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="商品不存在",
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
 * 获取热门商品
 *
 * @OA\Get(
 *     path="/api/v1/goods/hot/list",
 *     operationId="getHotGoods",
 *     tags={"商品管理"},
 *     summary="获取热门商品",
 *     description="获取销量最高的商品列表",
 *     @OA\Parameter(
 *         name="limit",
 *         in="query",
 *         description="返回数量",
 *         required=false,
 *         @OA\Schema(type="integer", default=10)
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
 *                         ref="#/components/schemas/HotGoodsListData"
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

/**
 * 获取商品分类
 *
 * @OA\Get(
 *     path="/api/v1/goods/category/list",
 *     operationId="getGoodsCategories",
 *     tags={"商品管理"},
 *     summary="获取商品分类",
 *     description="获取所有商品分类信息",
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
 *                         ref="#/components/schemas/CategoryListData"
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

