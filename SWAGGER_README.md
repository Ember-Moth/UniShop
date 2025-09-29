# Swagger API 文档使用说明

## 概述

本项目已经集成了Swagger/OpenAPI文档，为新增的3个API V1接口提供了完整的文档和测试界面。

## 文件结构

```
├── app/Http/Controllers/ApiV1/
│   └── OrderController.php          # API V1订单控制器（包含Swagger注释）
├── app/Http/Controllers/
│   └── SwaggerController.php        # Swagger UI控制器
├── resources/views/swagger/
│   └── index.blade.php              # Swagger UI页面
├── routes/common/apiv1/
│   └── order.php                    # API V1路由
├── swagger_complete.json            # 完整的Swagger JSON文档
└── SWAGGER_README.md                # 本说明文档
```

## 访问方式

### 1. Swagger UI 界面
访问地址：`http://your-domain.com/api/documentation`

### 2. API JSON 文档
访问地址：`http://your-domain.com/docs`

## 包含的API接口

### 1. 通过订单号查询订单
- **URL**: `POST /api/v1/order/search-by-sn`
- **功能**: 通过订单号查询单个订单详情
- **参数**: `order_sn` (订单号)

### 2. 通过邮箱查询订单
- **URL**: `POST /api/v1/order/search-by-email`
- **功能**: 通过邮箱查询该邮箱下的所有订单
- **参数**: `email` (邮箱), `search_pwd` (可选查询密码)

### 3. 通过浏览器缓存查询订单
- **URL**: `POST /api/v1/order/search-by-browser`
- **功能**: 查询浏览器Cookie中保存的订单
- **参数**: 无需参数

## 特性

### 1. 完整的Swagger注释
在 `OrderController.php` 中，每个方法都包含了详细的Swagger注释：
- 接口描述
- 请求参数定义
- 响应格式
- 错误码说明
- 示例数据

### 2. 交互式测试界面
通过Swagger UI，您可以：
- 查看API文档
- 直接在浏览器中测试API
- 查看请求和响应示例
- 下载API文档

### 3. 标准化的响应格式
所有API都使用统一的响应格式：
```json
{
    "code": 200,
    "message": "success",
    "data": {
        // 具体数据
    }
}
```

## 使用步骤

### 1. 启动项目
确保您的Laravel项目正常运行。

### 2. 访问Swagger UI
在浏览器中打开：`http://your-domain.com/api/documentation`

### 3. 测试API
1. 在Swagger UI中找到要测试的接口
2. 点击 "Try it out" 按钮
3. 填写请求参数
4. 点击 "Execute" 执行请求
5. 查看响应结果

## 示例

### 通过订单号查询
```bash
curl -X POST "http://your-domain.com/api/v1/order/search-by-sn" \
     -H "Content-Type: application/json" \
     -d '{"order_sn": "ABC123DEF456GHI7"}'
```

### 通过邮箱查询
```bash
curl -X POST "http://your-domain.com/api/v1/order/search-by-email" \
     -H "Content-Type: application/json" \
     -d '{"email": "user@example.com", "search_pwd": "123456"}'
```

### 通过浏览器缓存查询
```bash
curl -X POST "http://your-domain.com/api/v1/order/search-by-browser" \
     -H "Content-Type: application/json" \
     -b "dujiaoka_orders=[\"ABC123DEF456GHI7\"]"
```

## 扩展说明

### 1. 添加新的API接口
1. 在 `app/Http/Controllers/ApiV1/` 目录下创建新的控制器
2. 添加Swagger注释
3. 在 `routes/common/apiv1/` 目录下添加路由
4. 更新 `swagger_complete.json` 文档

### 2. 生成API文档
使用L5-Swagger包生成API文档：

```bash
php artisan l5-swagger:generate
```

### 3. 自定义配置
可以修改 `config/l5-swagger.php` 文件来自定义配置。

### 4. 自定义Swagger UI样式
可以修改 `resources/views/vendor/l5-swagger` 目录下的文件来自定义界面样式。

## 注意事项

1. **CSRF保护**: 所有POST请求都需要CSRF token
2. **参数验证**: 所有接口都包含完整的参数验证
3. **错误处理**: 统一的错误响应格式
4. **安全性**: 生产环境中建议添加API认证

## 故障排除

### 1. 页面无法访问
- 检查路由是否正确配置
- 确认Laravel项目正常运行
- 检查文件权限

### 2. API测试失败
- 检查请求参数格式
- 确认API接口正常工作
- 查看Laravel日志文件

### 3. 样式显示异常
- 检查网络连接（Swagger UI使用CDN）
- 尝试使用本地Swagger UI文件

## 更新日志

### V1.0.0 (2024-01-01)
- 新增3个订单查询API接口
- 集成Swagger UI界面
- 完整的API文档和测试功能
- 统一的响应格式和错误处理

php artisan l5-swagger:generate -v
