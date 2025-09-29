# 独角数卡 API V1 接口文档

## 概述

这是独角数卡项目的API V1版本，提供了RESTful风格的JSON API接口。

## 基础信息

- **基础URL**: `/api/v1`
- **数据格式**: JSON
- **字符编码**: UTF-8
- **请求方法**: POST

## 通用响应格式

### 成功响应
```json
{
    "code": 200,
    "message": "success",
    "data": {
        // 具体数据
    }
}
```

### 错误响应
```json
{
    "code": 400,
    "message": "错误信息",
    "data": null
}
```

## 状态码说明

| 状态码 | 说明 |
|--------|------|
| 200 | 请求成功 |
| 400 | 请求参数错误 |
| 404 | 资源不存在 |
| 500 | 服务器内部错误 |

---

## 订单查询接口

### 1. 通过订单号查询订单

#### 接口信息
- **URL**: `/api/v1/order/search-by-sn`
- **方法**: POST
- **描述**: 通过订单号查询单个订单详情

#### 请求参数
| 参数名 | 类型 | 必填 | 说明 |
|--------|------|------|------|
| order_sn | string | 是 | 订单号 |

#### 请求示例
```json
{
    "order_sn": "ABC123DEF456GHI7"
}
```

#### 响应示例
```json
{
    "code": 200,
    "message": "success",
    "data": {
        "order": {
            "id": 1,
            "order_sn": "ABC123DEF456GHI7",
            "title": "商品名称 x 1",
            "email": "user@example.com",
            "actual_price": "98.00",
            "status": 4,
            "created_at": "2024-01-01 12:00:00",
            "goods": {
                "id": 1,
                "gd_name": "商品名称",
                "gd_description": "商品描述"
            },
            "pay": {
                "id": 1,
                "pay_name": "支付宝"
            }
        }
    }
}
```

### 2. 通过邮箱查询订单

#### 接口信息
- **URL**: `/api/v1/order/search-by-email`
- **方法**: POST
- **描述**: 通过邮箱查询该邮箱下的所有订单

#### 请求参数
| 参数名 | 类型 | 必填 | 说明 |
|--------|------|------|------|
| email | string | 是 | 邮箱地址 |
| search_pwd | string | 否 | 查询密码（如果系统开启） |

#### 请求示例
```json
{
    "email": "user@example.com",
    "search_pwd": "123456"
}
```

#### 响应示例
```json
{
    "code": 200,
    "message": "success",
    "data": {
        "orders": [
            {
                "id": 1,
                "order_sn": "ABC123DEF456GHI7",
                "title": "商品名称 x 1",
                "email": "user@example.com",
                "actual_price": "98.00",
                "status": 4,
                "created_at": "2024-01-01 12:00:00"
            }
        ],
        "total": 1
    }
}
```

### 3. 通过浏览器缓存查询订单

#### 接口信息
- **URL**: `/api/v1/order/search-by-browser`
- **方法**: POST
- **描述**: 查询浏览器Cookie中保存的订单

#### 请求参数
无需参数，系统会自动从Cookie中获取订单号

#### 请求示例
```json
{}
```

#### 响应示例
```json
{
    "code": 200,
    "message": "success",
    "data": {
        "orders": [
            {
                "id": 1,
                "order_sn": "ABC123DEF456GHI7",
                "title": "商品名称 x 1",
                "email": "user@example.com",
                "actual_price": "98.00",
                "status": 4,
                "created_at": "2024-01-01 12:00:00"
            }
        ],
        "total": 1
    }
}
```

---

## 订单状态说明

| 状态值 | 说明 |
|--------|------|
| 1 | 待支付 |
| 2 | 待处理 |
| 3 | 处理中 |
| 4 | 已完成 |
| 5 | 处理失败 |
| 6 | 异常 |
| -1 | 过期 |

---

## 错误码说明

| 错误码 | 说明 |
|--------|------|
| 400 | 请求参数错误或非法请求 |
| 404 | 订单不存在或未找到相关订单 |
| 500 | 服务器内部错误 |

---

## 使用示例

### cURL 示例

#### 通过订单号查询
```bash
curl -X POST http://your-domain.com/api/v1/order/search-by-sn \
  -H "Content-Type: application/json" \
  -d '{"order_sn": "ABC123DEF456GHI7"}'
```

#### 通过邮箱查询
```bash
curl -X POST http://your-domain.com/api/v1/order/search-by-email \
  -H "Content-Type: application/json" \
  -d '{"email": "user@example.com", "search_pwd": "123456"}'
```

#### 通过浏览器缓存查询
```bash
curl -X POST http://your-domain.com/api/v1/order/search-by-browser \
  -H "Content-Type: application/json" \
  -b "dujiaoka_orders=[\"ABC123DEF456GHI7\"]"
```

### JavaScript 示例

```javascript
// 通过订单号查询
fetch('/api/v1/order/search-by-sn', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        order_sn: 'ABC123DEF456GHI7'
    })
})
.then(response => response.json())
.then(data => {
    if (data.code === 200) {
        console.log('订单信息:', data.data.order);
    } else {
        console.error('查询失败:', data.message);
    }
});
```

---

## 注意事项

1. **安全性**: 所有接口都包含参数验证和错误处理
2. **性能**: 邮箱和浏览器查询都限制返回最多5个订单
3. **兼容性**: 保持与原有Web接口相同的业务逻辑
4. **扩展性**: 为后续API版本升级预留了空间

---

## 更新日志

### V1.0.0 (2024-01-01)
- 新增订单查询API接口
- 支持通过订单号、邮箱、浏览器缓存查询订单
- 统一的JSON响应格式
- 完整的错误处理机制
