<p align="center">
  <img src="https://i.loli.net/2020/04/07/nAzjDJlX7oc5qEw.png" width="400">
</p>

<p align="center">
  <a href="https://opensource.org/licenses/AGPL-3.0"><img src="https://img.shields.io/badge/license-AGPL--3.0-blue" alt="license AGPL-3.0"></a>
  <a href="https://github.com/assimon/dujiaoka"><img src="https://img.shields.io/badge/based%20on-dujiaoka-green" alt="based on dujiaoka"></a>
  <a href="https://www.php.net/releases/7_4_0.php"><img src="https://img.shields.io/badge/PHP-7.4%2B-lightgrey" alt="PHP 7.4+"></a>
  <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-6.x-red" alt="Laravel 6.x"></a>
</p>

<p align="center">
  <strong>UniShop - 基于独角数卡的增强版自动售货系统</strong>
</p>

<p align="center">
  🚀 高效、稳定、功能丰富的开源电商解决方案
</p>

---

## 📖 项目简介

UniShop 是基于 [独角数卡(dujiaoka)](https://github.com/assimon/dujiaoka) 项目进行二次开发的增强版自动售货系统。在保留原有优秀特性的基础上，新增了多项实用功能，为站长提供更完善的电商解决方案。

### 🎯 核心特性

- **🏗️ 基于 Laravel 框架** - 安全稳定，性能优异
- **🎨 多模板支持** - 内置多种精美前端模板
- **🌍 多语言国际化** - 支持中英文等多语言切换
- **💳 丰富支付方式** - 集成主流支付平台
- **📱 响应式设计** - 完美适配各种设备
- **🔒 安全可靠** - 完善的权限管理和数据保护

---

## ✨ 相比原版的增强功能

### 🆕 新增特性

#### 1. **API V1 接口系统**
- 完整的 RESTful API 接口
- 支持订单查询、用户管理等核心功能
- 统一的 JSON 响应格式
- 完整的 Swagger 文档支持

#### 2. **用户余额系统**
- 用户余额充值功能
- 余额消费记录
- 充值订单管理
- 支持余额购买商品

#### 3. **增强的支付系统**
- 基于 V2Board 支付模块重构
- 支持更多支付方式：
  - Stripe 全系列（支付宝、微信、信用卡、Checkout）
  - EPay 支付
  - Coinbase 加密货币
  - BTCPay 比特币支付
  - CoinPayments 多币种支付

#### 4. **国际化货币支持**
- 多货币单位支持（CNY、USD、USDT、AUD、EUR、JPY、GBP）
- 自动汇率转换
- 灵活的货币符号配置

#### 5. **完善的文档系统**
- API 接口文档
- 支付系统使用说明
- Swagger 在线文档
- 详细的功能说明

### 🔧 技术改进

- **模块化支付架构** - 易于扩展新的支付方式
- **统一异常处理** - 更好的错误处理和日志记录
- **性能优化** - 数据库查询优化和缓存机制
- **代码规范** - 遵循 PSR 标准，代码更易维护

---

## 🏗️ 技术架构

### 核心技术栈

- **后端框架**: [Laravel 6.x](https://laravel.com/)
- **后台管理**: [Dcat Admin](https://github.com/jqhph/dcat-admin)
- **前端UI**: Bootstrap 4
- **数据库**: MySQL 5.7+
- **缓存**: Redis
- **队列**: Supervisor

### 项目结构

```
UniShop/
├── app/
│   ├── Admin/              # 后台管理模块
│   ├── Http/Controllers/   # 控制器
│   ├── Models/             # 数据模型
│   ├── Payments/           # 支付模块
│   ├── Services/           # 业务服务层
│   └── Jobs/               # 队列任务
├── config/                 # 配置文件
├── database/               # 数据库相关
├── resources/              # 视图和静态资源
├── routes/                 # 路由定义
└── storage/                # 存储目录
```

---

## 🚀 快速开始

### 环境要求

- **PHP**: >= 7.4
- **MySQL**: >= 5.6
- **Nginx**: >= 1.16
- **Redis**: 高性能缓存服务
- **Composer**: PHP包管理器
- **Supervisor**: 进程管理服务

### PHP 扩展要求

- ✅ `fileinfo` 扩展（必须）
- ✅ `redis` 扩展（必须）
- ✅ `openssl` 扩展（必须）
- ✅ `pdo_mysql` 扩展（必须）
- ✅ `mbstring` 扩展（必须）
- ✅ `tokenizer` 扩展（必须）
- ✅ `xml` 扩展（必须）
- ✅ `ctype` 扩展（必须）
- ✅ `json` 扩展（必须）
- ✅ `bcmath` 扩展（必须）

### 安装步骤

1. **克隆项目**
   ```bash
   git clone https://github.com/your-username/UniShop.git
   cd UniShop
   ```

2. **安装依赖**
   ```bash
   composer install
   ```

3. **环境配置**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **数据库配置**
   编辑 `.env` 文件，配置数据库连接：
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=unishop
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **导入数据库**
   ```bash
   mysql -u your_username -p your_password < database/sql/install.sql
   ```

6. **设置权限**
   ```bash
   chmod -R 755 storage
   chmod -R 755 bootstrap/cache
   ```

7. **启动队列服务**
   ```bash
   php artisan queue:work
   ```

8. **配置 Web 服务器**
   
   **Nginx 配置示例：**
   ```nginx
   server {
       listen 80;
       server_name your-domain.com;
       root /path/to/UniShop/public;
       
       index index.php index.html;
       
       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }
       
       location ~ \.php$ {
           fastcgi_pass 127.0.0.1:9000;
           fastcgi_index index.php;
           fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
           include fastcgi_params;
       }
   }
   ```

### 默认后台信息

- **后台地址**: `/admin`
- **默认账号**: `admin`
- **默认密码**: `admin`

⚠️ **重要**: 首次登录后请立即修改默认密码！

---

## 💳 支付方式

### 已集成的支付接口

- [x] **支付宝当面付** - 扫码支付
- [x] **支付宝PC支付** - 网页支付
- [x] **支付宝手机支付** - 移动端支付
- [x] **微信支付** - 扫码支付
- [x] **微信企业扫码支付** - 企业版
- [x] **PayJS微信扫码** - 第三方支付
- [x] **Paysapi** - 支付宝/微信
- [x] **码支付** - QQ/支付宝/微信
- [x] **PayPal支付** - 国际支付
- [x] **Stripe支付** - 全系列支持
- [x] **EPay支付** - 易支付
- [x] **Coinbase** - 加密货币
- [x] **BTCPay** - 比特币支付
- [x] **CoinPayments** - 多币种支付
- [x] **V免签支付** - 免签支付

---

## 📚 API 文档

### API V1 接口

UniShop 提供了完整的 RESTful API 接口：

- **文档地址**: `http://your-domain.com/api/documentation`
- **JSON文档**: `http://your-domain.com/docs`

#### 主要接口

1. **订单查询接口**
   - `POST /api/v1/order/search-by-sn` - 通过订单号查询
   - `POST /api/v1/order/search-by-email` - 通过邮箱查询
   - `POST /api/v1/order/search-by-browser` - 通过浏览器缓存查询

2. **用户管理接口**
   - 用户信息查询
   - 余额查询
   - 充值记录查询

### 使用示例

```bash

# 通过订单号查询
curl -X POST http://your-domain.com/api/v1/order/search-by-sn \
  -H "Content-Type: application/json" \
  -d '{"order_sn": "ORDER123456789"}'
```

---

## 🎨 前后端分离

UniShop 支持前后端分离架构，为开发者提供灵活的前端开发方案：

### 架构特点

- **API 优先设计** - 完整的 RESTful API 接口
- **JSON 数据交换** - 统一的数据格式
- **跨域支持** - CORS 配置支持跨域请求
- **JWT 认证** - 支持 Token 认证机制

### 前端开发支持

- **Vue.js** - 支持 Vue 2.x/3.x 框架
- **React** - 支持 React 应用开发
- **Angular** - 支持 Angular 框架
- **原生 JavaScript** - 支持原生 JS 开发
- **移动端应用** - 支持 React Native、Flutter 等

### API 接口

提供完整的 API 文档和测试界面：
- **Swagger 文档** - 在线 API 文档
- **接口测试** - 内置接口测试工具
- **响应格式** - 统一的 JSON 响应格式

---

## 🔧 系统配置

### 基础配置

- **站点名称**: 自定义网站标题
- **站点描述**: SEO 描述信息
- **默认语言**: 中文/英文切换
- **货币单位**: 支持多货币配置
- **时区设置**: 全球时区支持

### 安全设置

- **查询密码**: 订单查询密码验证
- **极验验证**: 人机验证保护
- **IP白名单**: 访问控制
- **邮件验证**: 订单通知验证

---

## 📊 功能模块

### 商品管理
- ✅ 商品信息管理
- ✅ 商品分组管理
- ✅ 库存管理
- ✅ 价格设置
- ✅ 商品状态控制

### 订单管理
- ✅ 订单创建与处理
- ✅ 订单状态跟踪
- ✅ 订单查询系统
- ✅ 批量操作支持
- ✅ 订单导出功能

### 支付管理
- ✅ 多种支付方式
- ✅ 支付状态监控
- ✅ 支付回调处理
- ✅ 退款管理
- ✅ 支付统计报表

### 卡密管理
- ✅ 卡密库存管理
- ✅ 卡密导入导出
- ✅ 卡密使用记录
- ✅ 卡密状态跟踪
- ✅ 批量操作支持

### 用户系统
- ✅ 用户注册登录
- ✅ 用户余额管理
- ✅ 充值订单管理
- ✅ 消费记录查询
- ✅ 用户权限控制

### 优惠券系统
- ✅ 优惠券创建
- ✅ 使用条件设置
- ✅ 使用记录跟踪
- ✅ 批量发放功能
- ✅ 过期自动处理

### 邮件系统
- ✅ 邮件模板管理
- ✅ 订单通知邮件
- ✅ 自定义邮件内容
- ✅ 邮件发送记录
- ✅ 多语言邮件支持

---

## 🛠️ 开发指南

### 添加新的支付方式

1. 在 `app/Payments/` 目录下创建支付类
2. 实现 `form()` 和 `pay()` 方法
3. 在后台配置中添加新的支付方式

### 自定义模板

1. 在 `resources/views/` 目录下创建新模板目录
2. 复制现有模板文件进行修改
3. 在配置文件中注册新模板

### API 开发

1. 在 `app/Http/Controllers/ApiV1/` 目录下创建控制器
2. 在 `routes/common/apiv1/` 目录下定义路由
3. 添加 Swagger 注释生成文档

---

## 📈 性能优化

### 缓存配置

- **Redis 缓存**: 配置 Redis 作为缓存驱动
- **页面缓存**: 启用页面静态缓存
- **查询缓存**: 数据库查询结果缓存

### 数据库优化

- **索引优化**: 为常用查询字段添加索引
- **查询优化**: 使用 Eloquent 关系预加载
- **分页处理**: 大数据量分页显示

### 队列处理

- **异步任务**: 邮件发送、支付回调等异步处理
- **队列监控**: 使用 Supervisor 管理队列进程
- **失败重试**: 自动重试失败的任务

---

## 🔒 安全建议

### 服务器安全

- 定期更新系统和软件
- 配置防火墙规则
- 使用 HTTPS 加密传输
- 定期备份数据

### 应用安全

- 修改默认管理员密码
- 启用查询密码验证
- 配置 IP 访问限制
- 定期清理日志文件

### 数据安全

- 数据库定期备份
- 敏感信息加密存储
- 访问日志记录
- 异常操作监控

---

## 🐛 常见问题

### 安装问题

**Q: Composer 安装失败怎么办？**
A: 尝试更换 Composer 镜像源：
```bash
composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/
```

**Q: 数据库连接失败？**
A: 检查 `.env` 文件中的数据库配置，确保数据库服务正在运行。

### 支付问题

**Q: 支付回调失败？**
A: 检查服务器防火墙设置，确保支付平台可以访问回调地址。

**Q: 订单状态不更新？**
A: 检查队列服务是否正常运行，支付回调可能通过队列异步处理。

### 性能问题

**Q: 页面加载慢？**
A: 启用 Redis 缓存，优化数据库查询，使用 CDN 加速静态资源。

---

## 🤝 贡献指南

我们欢迎任何形式的贡献！

### 如何贡献

1. **Fork** 本仓库
2. 创建你的特性分支 (`git checkout -b feature/AmazingFeature`)
3. 提交你的更改 (`git commit -m 'Add some AmazingFeature'`)
4. 推送到分支 (`git push origin feature/AmazingFeature`)
5. 开启一个 **Pull Request**

### 代码规范

- 遵循 PSR-12 代码规范
- 添加适当的注释和文档
- 编写单元测试（如果可能）
- 确保代码通过所有测试

---

## 📄 开源协议

本项目基于 [独角数卡 (dujiaoka)](https://github.com/assimon/dujiaoka) 进行二次开发。

- **原始项目**：由 [assimon](https://github.com/assimon) 开发，代码基于 [MIT License](https://opensource.org/licenses/MIT) 发布。
- **本项目修改与新增部分**：在原始项目基础上所做出的修改、扩展功能与新增模块，统一以 [GNU Affero General Public License v3.0 (AGPL-3.0)](https://opensource.org/licenses/AGPL-3.0) 发布。

### 许可证说明

AGPL-3.0 是一个强 copyleft 许可证，主要特点：

- ✅ **商业使用** - 允许商业使用
- ✅ **修改** - 允许修改代码
- ✅ **分发** - 允许分发代码
- ✅ **专利使用** - 允许专利使用
- ✅ **私人使用** - 允许私人使用

**重要要求：**
- 📋 **开源要求** - 基于本项目的衍生作品必须同样开源
- 📋 **网络服务条款** - 通过网络提供服务的衍生作品也需要开源
- 📋 **许可证声明** - 必须保留原许可证声明

更多详情请查看 [AGPL-3.0 许可证全文](https://www.gnu.org/licenses/agpl-3.0.html)。

---

## 🙏 致谢

### 原始项目

感谢 [assimon](https://github.com/assimon) 开发的优秀开源项目 [独角数卡(dujiaoka)](https://github.com/assimon/dujiaoka)，为我们的二次开发提供了坚实的基础。

### 贡献者

感谢所有为 UniShop 项目做出贡献的开发者们！

### 技术栈

- [Laravel](https://laravel.com/) - PHP Web 框架
- [Dcat Admin](https://github.com/jqhph/dcat-admin) - Laravel 后台管理框架
- [Bootstrap](https://getbootstrap.com/) - 前端 UI 框架
- [Stripe](https://stripe.com/) - 支付处理平台

---

## 📞 联系我们

- **项目地址**: [GitHub Repository](https://github.com/your-username/UniShop)
- **问题反馈**: [Issues](https://github.com/your-username/UniShop/issues)
- **功能建议**: [Discussions](https://github.com/your-username/UniShop/discussions)

---

## ⭐ 支持项目

如果 UniShop 对你有帮助，请给我们一个 ⭐ Star！

<p align="center">
  <strong>Made with ❤️ by UniShop Team</strong>
</p>
