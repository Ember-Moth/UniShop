# 生成 Swagger API 文档

## 使用 L5-Swagger 包

由于您已经安装了 `darkaonline/l5-swagger:^6.0` 包，现在可以使用以下命令来生成API文档：

### 1. 生成API文档
```bash
# 如果 php 命令在 PATH 中
php artisan l5-swagger:generate

# 或者使用完整路径（根据您的系统调整）
/usr/local/bin/php artisan l5-swagger:generate
# 或者
/opt/homebrew/bin/php artisan l5-swagger:generate
```

### 2. 访问API文档
- **Swagger UI**: `http://your-domain.com/api/documentation`
- **JSON文档**: `http://your-domain.com/docs`

### 3. 配置说明

#### 配置文件位置
- `config/l5-swagger.php` - L5-Swagger配置文件

#### 主要配置项
- `documentations.default.api.title` - API文档标题
- `documentations.default.routes.api` - Swagger UI访问路径
- `documentations.default.paths.annotations` - 扫描注释的目录
- `defaults.paths.docs` - 生成的文档存储位置

### 4. 注释格式

在控制器中使用以下格式的注释：

```php
/**
 * @OA\Post(
 *     path="/api/v1/order/search-by-sn",
 *     tags={"订单管理"},
 *     summary="通过订单号查询订单",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"order_sn"},
 *             @OA\Property(property="order_sn", type="string", example="ABC123DEF456GHI7")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="查询成功",
 *         @OA\JsonContent(
 *             @OA\Property(property="code", type="integer", example=200),
 *             @OA\Property(property="message", type="string", example="success"),
 *             @OA\Property(property="data", type="object")
 *         )
 *     )
 * )
 */
```

### 5. 环境变量配置

可以在 `.env` 文件中添加以下配置：

```env
# L5-Swagger 配置
L5_SWAGGER_GENERATE_ALWAYS=true
L5_SWAGGER_UI_DOC_EXPANSION=list
L5_SWAGGER_UI_FILTERS=true
L5_SWAGGER_CONST_HOST=http://your-domain.com
```

### 6. 清理和重新生成

如果需要清理并重新生成文档：

```bash
# 清理生成的文档
rm -rf storage/api-docs

# 重新生成
php artisan l5-swagger:generate
```

### 7. 注意事项

1. **注释格式**: 确保使用正确的 `@OA\` 注释格式
2. **文件扫描**: 默认扫描 `app/` 目录下的所有PHP文件
3. **缓存**: 如果修改了注释，需要重新生成文档
4. **权限**: 确保 `storage/api-docs` 目录有写入权限

### 8. 故障排除

#### 文档不更新
- 检查注释格式是否正确
- 重新运行 `php artisan l5-swagger:generate`
- 清除浏览器缓存

#### 页面无法访问
- 检查路由是否正确配置
- 确认L5-Swagger包已正确安装
- 检查文件权限

#### 注释不被识别
- 确保注释格式正确
- 检查文件是否在扫描目录中
- 确认PHP语法正确
