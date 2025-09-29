# Dujiaoka 支付系统 API 使用示例

## 📋 概述

本文档提供了Dujiaoka支付系统API的详细使用示例，包括用户认证、支付订单创建、状态查询等功能的完整流程。

## 🔐 认证方式

所有需要认证的API都使用Bearer Token认证方式。用户登录后获取的`access_token`需要在请求头中携带：

```bash
Authorization: Bearer your_access_token_here
```

## 📝 API 接口列表

### 1. 用户管理接口

#### 1.1 用户注册
```bash
POST /api/v1/user/register
Content-Type: application/json

{
    "username": "testuser",
    "password": "123456",
    "password_confirmation": "123456"
}
```

**响应示例：**
```json
{
    "code": 200,
    "message": "注册成功",
    "data": {
        "user_id": 1,
        "username": "testuser",
        "amount": "0.00",
        "secret": "user_secret_key_123456"
    }
}
```

#### 1.2 用户登录
```bash
POST /api/v1/user/login
Content-Type: application/json

{
    "username": "testuser",
    "password": "123456"
}
```

**响应示例：**
```json
{
    "code": 200,
    "message": "登录成功",
    "data": {
        "user_id": 1,
        "username": "testuser",
        "amount": "100.00",
        "secret": "user_secret_key_123456",
        "access_token": "user_secret_key_123456",
        "token_type": "Bearer"
    }
}
```

### 2. 支付管理接口

#### 2.1 获取支持的支付方式列表
```bash
GET /api/v1/payment/methods
Authorization: Bearer user_secret_key_123456
```

**响应示例：**
```json
{
    "code": 200,
    "message": "获取成功",
    "data": [
        {
            "type": "alipay_f2f",
            "name": "支付宝当面付",
            "description": "支付宝扫码支付",
            "payment_type": "qrcode",
            "supported_currencies": ["CNY"]
        },
        {
            "type": "epay",
            "name": "EPay支付",
            "description": "通用支付网关",
            "payment_type": "redirect",
            "supported_currencies": ["CNY"]
        },
        {
            "type": "stripe_checkout",
            "name": "Stripe结账",
            "description": "Stripe Checkout页面支付",
            "payment_type": "redirect",
            "supported_currencies": ["USD", "EUR", "GBP", "JPY", "CAD", "AUD"]
        }
    ]
}
```

#### 2.2 创建支付订单
```bash
POST /api/v1/payment/create
Authorization: Bearer user_secret_key_123456
Content-Type: application/json

{
    "total_amount": 10000,
    "payment_type": "alipay_f2f",
    "product_name": "商品购买",
    "description": "订单描述"
}
```

**响应示例：**
```json
{
    "code": 200,
    "message": "创建成功",
    "data": {
        "trade_no": "ORDER_1704067200_1",
        "payment_type": "alipay_f2f",
        "type": 0,
        "data": "https://qr.alipay.com/xxx",
        "amount": 10000,
        "status": "pending"
    }
}
```

#### 2.3 查询支付订单状态
```bash
GET /api/v1/payment/status/ORDER_1704067200_1
Authorization: Bearer user_secret_key_123456
```

**响应示例：**
```json
{
    "code": 200,
    "message": "查询成功",
    "data": {
        "trade_no": "ORDER_1704067200_1",
        "user_id": 1,
        "total_amount": 10000,
        "payment_type": "alipay_f2f",
        "status": "paid",
        "product_name": "商品购买",
        "description": "订单描述",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

## 🔄 完整支付流程示例

### 步骤1：用户注册
```bash
curl -X POST http://localhost:8000/api/v1/user/register \
  -H "Content-Type: application/json" \
  -d '{
    "username": "testuser",
    "password": "123456",
    "password_confirmation": "123456"
  }'
```

### 步骤2：用户登录
```bash
curl -X POST http://localhost:8000/api/v1/user/login \
  -H "Content-Type: application/json" \
  -d '{
    "username": "testuser",
    "password": "123456"
  }'
```

### 步骤3：获取支付方式列表
```bash
curl -X GET http://localhost:8000/api/v1/payment/methods \
  -H "Authorization: Bearer user_secret_key_123456"
```

### 步骤4：创建支付订单
```bash
curl -X POST http://localhost:8000/api/v1/payment/create \
  -H "Authorization: Bearer user_secret_key_123456" \
  -H "Content-Type: application/json" \
  -d '{
    "total_amount": 10000,
    "payment_type": "alipay_f2f",
    "product_name": "商品购买",
    "description": "订单描述"
  }'
```

### 步骤5：查询支付状态
```bash
curl -X GET http://localhost:8000/api/v1/payment/status/ORDER_1704067200_1 \
  -H "Authorization: Bearer user_secret_key_123456"
```

## 💳 不同支付方式示例

### 支付宝当面付 (alipay_f2f)
```bash
# 创建支付宝支付订单
curl -X POST http://localhost:8000/api/v1/payment/create \
  -H "Authorization: Bearer user_secret_key_123456" \
  -H "Content-Type: application/json" \
  -d '{
    "total_amount": 10000,
    "payment_type": "alipay_f2f",
    "product_name": "支付宝商品"
  }'

# 响应：返回二维码URL
{
    "code": 200,
    "message": "创建成功",
    "data": {
        "trade_no": "ORDER_1704067200_1",
        "payment_type": "alipay_f2f",
        "type": 0,
        "data": "https://qr.alipay.com/xxx",
        "amount": 10000,
        "status": "pending"
    }
}
```

### EPay支付 (epay)
```bash
# 创建EPay支付订单
curl -X POST http://localhost:8000/api/v1/payment/create \
  -H "Authorization: Bearer user_secret_key_123456" \
  -H "Content-Type: application/json" \
  -d '{
    "total_amount": 10000,
    "payment_type": "epay",
    "product_name": "EPay商品"
  }'

# 响应：返回跳转URL
{
    "code": 200,
    "message": "创建成功",
    "data": {
        "trade_no": "ORDER_1704067200_2",
        "payment_type": "epay",
        "type": 1,
        "data": "https://epay.example.com/submit.php?xxx",
        "amount": 10000,
        "status": "pending"
    }
}
```

### Stripe结账 (stripe_checkout)
```bash
# 创建Stripe支付订单
curl -X POST http://localhost:8000/api/v1/payment/create \
  -H "Authorization: Bearer user_secret_key_123456" \
  -H "Content-Type: application/json" \
  -d '{
    "total_amount": 10000,
    "payment_type": "stripe_checkout",
    "product_name": "Stripe商品"
  }'

# 响应：返回Stripe Checkout页面URL
{
    "code": 200,
    "message": "创建成功",
    "data": {
        "trade_no": "ORDER_1704067200_3",
        "payment_type": "stripe_checkout",
        "type": 1,
        "data": "https://checkout.stripe.com/xxx",
        "amount": 10000,
        "status": "pending"
    }
}
```

## 🔧 错误处理示例

### 参数错误
```bash
# 请求：缺少必需参数
curl -X POST http://localhost:8000/api/v1/payment/create \
  -H "Authorization: Bearer user_secret_key_123456" \
  -H "Content-Type: application/json" \
  -d '{
    "total_amount": 10000
  }'

# 响应
{
    "code": 400,
    "message": "参数错误",
    "errors": {
        "payment_type": ["The payment type field is required."]
    }
}
```

### 认证失败
```bash
# 请求：无效的Token
curl -X GET http://localhost:8000/api/v1/payment/methods \
  -H "Authorization: Bearer invalid_token"

# 响应
{
    "code": 401,
    "message": "未授权访问"
}
```

### 支付方式不支持
```bash
# 请求：不支持的支付方式
curl -X POST http://localhost:8000/api/v1/payment/create \
  -H "Authorization: Bearer user_secret_key_123456" \
  -H "Content-Type: application/json" \
  -d '{
    "total_amount": 10000,
    "payment_type": "unsupported_payment"
  }'

# 响应
{
    "code": 400,
    "message": "不支持的支付方式"
}
```

## 📊 状态码说明

| 状态码 | 说明 |
|--------|------|
| 200 | 请求成功 |
| 400 | 参数错误或业务逻辑错误 |
| 401 | 未授权访问 |
| 403 | 禁止访问 |
| 404 | 资源不存在 |
| 500 | 服务器内部错误 |

## 🔒 安全注意事项

1. **Token安全**
   - 不要在客户端存储Token
   - Token过期后需要重新登录
   - 定期更换Token

2. **请求安全**
   - 使用HTTPS协议
   - 验证请求来源
   - 防止重放攻击

3. **数据验证**
   - 验证所有输入参数
   - 检查订单金额
   - 验证支付回调签名

## 🚀 环境配置

### 开发环境
```bash
# 本地开发服务器
BASE_URL=http://localhost:8000
```

### 生产环境
```bash
# 生产服务器
BASE_URL=https://api.dujiaoka.com
```

## 📞 技术支持

如果在使用过程中遇到问题，请：

1. 查看API响应中的错误信息
2. 检查请求参数是否正确
3. 确认Token是否有效
4. 查看服务器日志
5. 联系技术支持团队

---

**注意**: 本文档中的示例仅供参考，实际使用时请根据您的具体需求进行调整。
