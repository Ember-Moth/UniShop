# 独角数卡 API 接口文档

## 项目简介

独角数卡是一个基于Laravel框架的开源自动化售货解决方案，支持多种支付方式，提供完整的商品销售和订单管理功能。

## 基础信息

- **框架**: Laravel
- **后台管理**: Dcat Admin
- **前端UI**: Bootstrap
- **支持语言**: 多语言国际化

---

## 🏠 前台用户API

### 1. 首页相关

#### 1.1 首页展示
- **接口**: `GET /`
- **描述**: 获取首页商品列表
- **控制器**: `HomeController@index`
- **返回**: 首页视图，包含商品数据

#### 1.2 极验验证
- **接口**: `GET /check-geetest`
- **描述**: 获取极验验证码
- **控制器**: `HomeController@geetest`
- **返回**: 极验验证配置

### 2. 商品相关

#### 2.1 商品详情
- **接口**: `GET /buy/{id}`
- **描述**: 获取商品详情页面
- **参数**: 
  - `id` (int): 商品ID
- **控制器**: `HomeController@buy`
- **返回**: 商品详情页面，包含支付方式

### 3. 订单相关

#### 3.1 创建订单
- **接口**: `POST /create-order`
- **描述**: 创建新订单
- **参数**:
  - `by_amount` (int): 购买数量
  - `payway` (int): 支付方式ID
  - `email` (string): 邮箱
  - `search_pwd` (string, optional): 查询密码
  - `coupon` (string, optional): 优惠码
- **控制器**: `OrderController@createOrder`
- **返回**: 重定向到结算页面

#### 3.2 结算页面
- **接口**: `GET /bill/{orderSN}`
- **描述**: 订单结算页面
- **参数**:
  - `orderSN` (string): 订单号
- **控制器**: `OrderController@bill`
- **返回**: 结算页面视图

#### 3.3 订单详情
- **接口**: `GET /detail-order-sn/{orderSN}`
- **描述**: 通过订单号查看订单详情
- **参数**:
  - `orderSN` (string): 订单号
- **控制器**: `OrderController@detailOrderSN`
- **返回**: 订单详情页面

#### 3.4 订单查询页面
- **接口**: `GET /order-search`
- **描述**: 订单查询页面
- **控制器**: `OrderController@orderSearch`
- **返回**: 订单查询页面视图

#### 3.5 检查订单状态
- **接口**: `GET /check-order-status/{orderSN}`
- **描述**: 检查订单支付状态
- **参数**:
  - `orderSN` (string): 订单号
- **控制器**: `OrderController@checkOrderStatus`
- **返回**: 订单状态信息

#### 3.6 通过订单号查询
- **接口**: `POST /search-order-by-sn`
- **描述**: 通过订单号查询订单
- **参数**:
  - `order_sn` (string): 订单号
- **控制器**: `OrderController@searchOrderBySN`
- **返回**: 订单信息

#### 3.7 通过邮箱查询
- **接口**: `POST /search-order-by-email`
- **描述**: 通过邮箱查询订单
- **参数**:
  - `email` (string): 邮箱地址
- **控制器**: `OrderController@searchOrderByEmail`
- **返回**: 订单列表

#### 3.8 通过浏览器查询
- **接口**: `POST /search-order-by-browser`
- **描述**: 通过浏览器查询订单
- **参数**:
  - `search_pwd` (string): 查询密码
- **控制器**: `OrderController@searchOrderByBrowser`
- **返回**: 订单列表

### 4. 系统安装

#### 4.1 安装页面
- **接口**: `GET /install`
- **描述**: 系统安装页面
- **控制器**: `HomeController@install`
- **返回**: 安装页面视图

#### 4.2 执行安装
- **接口**: `POST /install`
- **描述**: 执行系统安装
- **控制器**: `HomeController@doInstall`
- **返回**: 安装结果

---

## 💳 支付网关API

### 1. 支付网关入口

#### 1.1 支付网关重定向
- **接口**: `GET /pay-gateway/{handle}/{payway}/{orderSN}`
- **描述**: 支付网关统一入口
- **参数**:
  - `handle` (string): 支付处理器
  - `payway` (string): 支付方式
  - `orderSN` (string): 订单号
- **控制器**: `PayController@redirectGateway`
- **返回**: 重定向到对应支付页面

### 2. 支付宝支付

#### 2.1 支付宝支付网关
- **接口**: `GET /pay/alipay/{payway}/{orderSN}`
- **描述**: 支付宝支付处理
- **参数**:
  - `payway` (string): 支付方式 (zfbf2f/alipayscan/aliweb/aliwap)
  - `orderSN` (string): 订单号
- **控制器**: `AlipayController@gateway`
- **返回**: 支付页面或二维码

#### 2.2 支付宝异步通知
- **接口**: `POST /pay/alipay/notify_url`
- **描述**: 支付宝支付结果异步通知
- **控制器**: `AlipayController@notifyUrl`
- **返回**: 处理结果

### 3. 微信支付

#### 3.1 微信支付网关
- **接口**: `GET /pay/wepay/{payway}/{orderSN}`
- **描述**: 微信支付处理
- **参数**:
  - `payway` (string): 支付方式
  - `orderSN` (string): 订单号
- **控制器**: `WepayController@gateway`
- **返回**: 支付页面或二维码

#### 3.2 微信异步通知
- **接口**: `POST /pay/wepay/notify_url`
- **描述**: 微信支付结果异步通知
- **控制器**: `WepayController@notifyUrl`
- **返回**: 处理结果

### 4. 码支付

#### 4.1 码支付网关
- **接口**: `GET /pay/mapay/{payway}/{orderSN}`
- **描述**: 码支付处理
- **参数**:
  - `payway` (string): 支付方式
  - `orderSN` (string): 订单号
- **控制器**: `MapayController@gateway`
- **返回**: 支付页面或二维码

#### 4.2 码支付异步通知
- **接口**: `POST /pay/mapay/notify_url`
- **描述**: 码支付结果异步通知
- **控制器**: `MapayController@notifyUrl`
- **返回**: 处理结果

### 5. Paysapi支付

#### 5.1 Paysapi支付网关
- **接口**: `GET /pay/paysapi/{payway}/{orderSN}`
- **描述**: Paysapi支付处理
- **参数**:
  - `payway` (string): 支付方式
  - `orderSN` (string): 订单号
- **控制器**: `PaysapiController@gateway`
- **返回**: 支付页面

#### 5.2 Paysapi异步通知
- **接口**: `POST /pay/paysapi/notify_url`
- **描述**: Paysapi支付结果异步通知
- **控制器**: `PaysapiController@notifyUrl`
- **返回**: 处理结果

#### 5.3 Paysapi返回地址
- **接口**: `GET /pay/paysapi/return_url`
- **描述**: Paysapi支付完成返回地址
- **控制器**: `PaysapiController@returnUrl`
- **返回**: 支付结果页面

### 6. PayJS支付

#### 6.1 PayJS支付网关
- **接口**: `GET /pay/payjs/{payway}/{orderSN}`
- **描述**: PayJS支付处理
- **参数**:
  - `payway` (string): 支付方式
  - `orderSN` (string): 订单号
- **控制器**: `PayjsController@gateway`
- **返回**: 支付页面或二维码

#### 6.2 PayJS异步通知
- **接口**: `POST /pay/payjs/notify_url`
- **描述**: PayJS支付结果异步通知
- **控制器**: `PayjsController@notifyUrl`
- **返回**: 处理结果

### 7. 易支付

#### 7.1 易支付网关
- **接口**: `GET /pay/yipay/{payway}/{orderSN}`
- **描述**: 易支付处理
- **参数**:
  - `payway` (string): 支付方式
  - `orderSN` (string): 订单号
- **控制器**: `YipayController@gateway`
- **返回**: 支付页面

#### 7.2 易支付异步通知
- **接口**: `GET /pay/yipay/notify_url`
- **描述**: 易支付结果异步通知
- **控制器**: `YipayController@notifyUrl`
- **返回**: 处理结果

#### 7.3 易支付返回地址
- **接口**: `GET /pay/yipay/return_url`
- **描述**: 易支付支付完成返回地址
- **控制器**: `YipayController@returnUrl`
- **返回**: 支付结果页面

### 8. PayPal支付

#### 8.1 PayPal支付网关
- **接口**: `GET /pay/paypal/{payway}/{orderSN}`
- **描述**: PayPal支付处理
- **参数**:
  - `payway` (string): 支付方式
  - `orderSN` (string): 订单号
- **控制器**: `PaypalPayController@gateway`
- **返回**: PayPal支付页面

#### 8.2 PayPal返回地址
- **接口**: `GET /pay/paypal/return_url`
- **描述**: PayPal支付完成返回地址
- **控制器**: `PaypalPayController@returnUrl`
- **返回**: 支付结果页面

#### 8.3 PayPal异步通知
- **接口**: `ANY /pay/paypal/notify_url`
- **描述**: PayPal支付结果异步通知
- **控制器**: `PaypalPayController@notifyUrl`
- **返回**: 处理结果

### 9. V免签支付

#### 9.1 V免签支付网关
- **接口**: `GET /pay/vpay/{payway}/{orderSN}`
- **描述**: V免签支付处理
- **参数**:
  - `payway` (string): 支付方式
  - `orderSN` (string): 订单号
- **控制器**: `VpayController@gateway`
- **返回**: 支付页面

#### 9.2 V免签异步通知
- **接口**: `GET /pay/vpay/notify_url`
- **描述**: V免签支付结果异步通知
- **控制器**: `VpayController@notifyUrl`
- **返回**: 处理结果

#### 9.3 V免签返回地址
- **接口**: `GET /pay/vpay/return_url`
- **描述**: V免签支付完成返回地址
- **控制器**: `VpayController@returnUrl`
- **返回**: 支付结果页面

### 10. Stripe支付

#### 10.1 Stripe支付网关
- **接口**: `GET /pay/stripe/{payway}/{oid}`
- **描述**: Stripe支付处理
- **参数**:
  - `payway` (string): 支付方式
  - `oid` (string): 订单ID
- **控制器**: `StripeController@gateway`
- **返回**: Stripe支付页面

#### 10.2 Stripe返回地址
- **接口**: `GET /pay/stripe/return_url`
- **描述**: Stripe支付完成返回地址
- **控制器**: `StripeController@returnUrl`
- **返回**: 支付结果页面

#### 10.3 Stripe检查
- **接口**: `GET /pay/stripe/check`
- **描述**: Stripe支付状态检查
- **控制器**: `StripeController@check`
- **返回**: 支付状态

#### 10.4 Stripe扣费
- **接口**: `GET /pay/stripe/charge`
- **描述**: Stripe扣费处理
- **控制器**: `StripeController@charge`
- **返回**: 扣费结果

### 11. Coinbase支付

#### 11.1 Coinbase支付网关
- **接口**: `GET /pay/coinbase/{payway}/{orderSN}`
- **描述**: Coinbase支付处理
- **参数**:
  - `payway` (string): 支付方式
  - `orderSN` (string): 订单号
- **控制器**: `CoinbaseController@gateway`
- **返回**: Coinbase支付页面

#### 11.2 Coinbase异步通知
- **接口**: `POST /pay/coinbase/notify_url`
- **描述**: Coinbase支付结果异步通知
- **控制器**: `CoinbaseController@notifyUrl`
- **返回**: 处理结果

### 12. EPUSDT支付

#### 12.1 EPUSDT支付网关
- **接口**: `GET /pay/epusdt/{payway}/{orderSN}`
- **描述**: EPUSDT支付处理
- **参数**:
  - `payway` (string): 支付方式
  - `orderSN` (string): 订单号
- **控制器**: `EpusdtController@gateway`
- **返回**: EPUSDT支付页面

#### 12.2 EPUSDT异步通知
- **接口**: `POST /pay/epusdt/notify_url`
- **描述**: EPUSDT支付结果异步通知
- **控制器**: `EpusdtController@notifyUrl`
- **返回**: 处理结果

#### 12.3 EPUSDT返回地址
- **接口**: `GET /pay/epusdt/return_url`
- **描述**: EPUSDT支付完成返回地址
- **控制器**: `EpusdtController@returnUrl`
- **返回**: 支付结果页面

### 13. TokenPay支付

#### 13.1 TokenPay支付网关
- **接口**: `GET /pay/tokenpay/{payway}/{orderSN}`
- **描述**: TokenPay支付处理
- **参数**:
  - `payway` (string): 支付方式
  - `orderSN` (string): 订单号
- **控制器**: `TokenPayController@gateway`
- **返回**: TokenPay支付页面

#### 13.2 TokenPay异步通知
- **接口**: `POST /pay/tokenpay/notify_url`
- **描述**: TokenPay支付结果异步通知
- **控制器**: `TokenPayController@notifyUrl`
- **返回**: 处理结果

#### 13.3 TokenPay返回地址
- **接口**: `GET /pay/tokenpay/return_url`
- **描述**: TokenPay支付完成返回地址
- **控制器**: `TokenPayController@returnUrl`
- **返回**: 支付结果页面

---

## 🔧 后台管理API

### 1. 基础管理

#### 1.1 后台首页
- **接口**: `GET /admin/`
- **描述**: 后台管理首页
- **控制器**: `HomeController@index`
- **返回**: 后台首页视图

### 2. 商品管理

#### 2.1 商品列表
- **接口**: `GET /admin/goods`
- **描述**: 获取商品列表
- **控制器**: `GoodsController@index`
- **返回**: 商品列表页面

#### 2.2 创建商品
- **接口**: `POST /admin/goods`
- **描述**: 创建新商品
- **控制器**: `GoodsController@store`
- **返回**: 创建结果

#### 2.3 编辑商品
- **接口**: `PUT /admin/goods/{id}`
- **描述**: 更新商品信息
- **参数**:
  - `id` (int): 商品ID
- **控制器**: `GoodsController@update`
- **返回**: 更新结果

#### 2.4 删除商品
- **接口**: `DELETE /admin/goods/{id}`
- **描述**: 删除商品
- **参数**:
  - `id` (int): 商品ID
- **控制器**: `GoodsController@destroy`
- **返回**: 删除结果

#### 2.5 商品分组管理
- **接口**: `GET/POST/PUT/DELETE /admin/goods-group`
- **描述**: 商品分组CRUD操作
- **控制器**: `GoodsGroupController`
- **返回**: 分组管理结果

### 3. 卡密管理

#### 3.1 卡密列表
- **接口**: `GET /admin/carmis`
- **描述**: 获取卡密列表
- **控制器**: `CarmisController@index`
- **返回**: 卡密列表页面

#### 3.2 创建卡密
- **接口**: `POST /admin/carmis`
- **描述**: 创建新卡密
- **控制器**: `CarmisController@store`
- **返回**: 创建结果

#### 3.3 编辑卡密
- **接口**: `PUT /admin/carmis/{id}`
- **描述**: 更新卡密信息
- **参数**:
  - `id` (int): 卡密ID
- **控制器**: `CarmisController@update`
- **返回**: 更新结果

#### 3.4 删除卡密
- **接口**: `DELETE /admin/carmis/{id}`
- **描述**: 删除卡密
- **参数**:
  - `id` (int): 卡密ID
- **控制器**: `CarmisController@destroy`
- **返回**: 删除结果

#### 3.5 导入卡密
- **接口**: `GET /admin/import-carmis`
- **描述**: 批量导入卡密
- **控制器**: `CarmisController@importCarmis`
- **返回**: 导入页面

### 4. 优惠券管理

#### 4.1 优惠券列表
- **接口**: `GET /admin/coupon`
- **描述**: 获取优惠券列表
- **控制器**: `CouponController@index`
- **返回**: 优惠券列表页面

#### 4.2 创建优惠券
- **接口**: `POST /admin/coupon`
- **描述**: 创建新优惠券
- **控制器**: `CouponController@store`
- **返回**: 创建结果

#### 4.3 编辑优惠券
- **接口**: `PUT /admin/coupon/{id}`
- **描述**: 更新优惠券信息
- **参数**:
  - `id` (int): 优惠券ID
- **控制器**: `CouponController@update`
- **返回**: 更新结果

#### 4.4 删除优惠券
- **接口**: `DELETE /admin/coupon/{id}`
- **描述**: 删除优惠券
- **参数**:
  - `id` (int): 优惠券ID
- **控制器**: `CouponController@destroy`
- **返回**: 删除结果

### 5. 邮件模板管理

#### 5.1 邮件模板列表
- **接口**: `GET /admin/emailtpl`
- **描述**: 获取邮件模板列表
- **控制器**: `EmailtplController@index`
- **返回**: 邮件模板列表页面

#### 5.2 创建邮件模板
- **接口**: `POST /admin/emailtpl`
- **描述**: 创建新邮件模板
- **控制器**: `EmailtplController@store`
- **返回**: 创建结果

#### 5.3 编辑邮件模板
- **接口**: `PUT /admin/emailtpl/{id}`
- **描述**: 更新邮件模板信息
- **参数**:
  - `id` (int): 邮件模板ID
- **控制器**: `EmailtplController@update`
- **返回**: 更新结果

#### 5.4 删除邮件模板
- **接口**: `DELETE /admin/emailtpl/{id}`
- **描述**: 删除邮件模板
- **参数**:
  - `id` (int): 邮件模板ID
- **控制器**: `EmailtplController@destroy`
- **返回**: 删除结果

### 6. 支付配置管理

#### 6.1 支付配置列表
- **接口**: `GET /admin/pay`
- **描述**: 获取支付配置列表
- **控制器**: `PayController@index`
- **返回**: 支付配置列表页面

#### 6.2 创建支付配置
- **接口**: `POST /admin/pay`
- **描述**: 创建新支付配置
- **控制器**: `PayController@store`
- **返回**: 创建结果

#### 6.3 编辑支付配置
- **接口**: `PUT /admin/pay/{id}`
- **描述**: 更新支付配置信息
- **参数**:
  - `id` (int): 支付配置ID
- **控制器**: `PayController@update`
- **返回**: 更新结果

#### 6.4 删除支付配置
- **接口**: `DELETE /admin/pay/{id}`
- **描述**: 删除支付配置
- **参数**:
  - `id` (int): 支付配置ID
- **控制器**: `PayController@destroy`
- **返回**: 删除结果

### 7. 订单管理

#### 7.1 订单列表
- **接口**: `GET /admin/order`
- **描述**: 获取订单列表
- **控制器**: `OrderController@index`
- **返回**: 订单列表页面

#### 7.2 创建订单
- **接口**: `POST /admin/order`
- **描述**: 创建新订单
- **控制器**: `OrderController@store`
- **返回**: 创建结果

#### 7.3 编辑订单
- **接口**: `PUT /admin/order/{id}`
- **描述**: 更新订单信息
- **参数**:
  - `id` (int): 订单ID
- **控制器**: `OrderController@update`
- **返回**: 更新结果

#### 7.4 删除订单
- **接口**: `DELETE /admin/order/{id}`
- **描述**: 删除订单
- **参数**:
  - `id` (int): 订单ID
- **控制器**: `OrderController@destroy`
- **返回**: 删除结果

### 8. 系统设置

#### 8.1 系统设置页面
- **接口**: `GET /admin/system-setting`
- **描述**: 系统设置页面
- **控制器**: `SystemSettingController@systemSetting`
- **返回**: 系统设置页面

### 9. 邮件测试

#### 9.1 邮件测试功能
- **接口**: `GET /admin/email-test`
- **描述**: 邮件发送测试
- **控制器**: `EmailTestController@emailTest`
- **返回**: 邮件测试结果

---

## 📋 API统计总结

### 接口数量统计
- **前台用户API**: 15个接口
- **支付网关API**: 39个接口
- **后台管理API**: 25个接口
- **总计**: 79个接口

### 支持的支付方式
1. 支付宝 (当面付、PC支付、手机支付)
2. 微信支付
3. 码支付
4. Paysapi
5. PayJS
6. 易支付
7. PayPal
8. V免签
9. Stripe
10. Coinbase
11. EPUSDT
12. TokenPay

### 主要功能模块
1. **商品管理**: 商品展示、分组管理
2. **订单管理**: 订单创建、查询、状态管理
3. **支付处理**: 多种支付方式集成
4. **卡密管理**: 卡密库存、导入管理
5. **优惠券系统**: 优惠券创建和管理
6. **邮件系统**: 邮件模板和发送
7. **系统设置**: 基础配置管理

### 技术特点
- 基于Laravel框架，安全稳定
- 支持多语言国际化
- 模块化设计，易于扩展
- 完整的支付生态集成
- 响应式前端设计


search-order-by-sn
search-order-by-ema
search-order-by-bro