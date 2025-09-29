<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 检查表是否存在，如果不存在则创建
        if (!DB::getSchemaBuilder()->hasTable('system_configs')) {
            $this->createSystemConfigsTable();
        }

        // 清空现有数据
        DB::table('system_configs')->truncate();

        // 插入系统配置数据
        $configs = [
            // 货币配置
            [
                'key' => 'currency_unit',
                'value' => 'CNY',
                'description' => '默认货币单位',
                'type' => 'select',
                'options' => json_encode([
                    'CNY' => '人民币',
                    'USD' => '美元',
                    'USDT' => 'USDT',
                    'AUD' => '澳元',
                    'EUR' => '欧元',
                    'JPY' => '日元',
                    'GBP' => '英镑'
                ]),
                'group' => 'currency',
                'sort_order' => 1,
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'currency_symbol',
                'value' => '¥',
                'description' => '默认货币符号',
                'type' => 'select',
                'options' => json_encode([
                    '¥' => '¥ (人民币)',
                    '$' => '$ (美元)',
                    '€' => '€ (欧元)',
                    '£' => '£ (英镑)',
                    'A$' => 'A$ (澳元)'
                ]),
                'group' => 'currency',
                'sort_order' => 2,
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'supported_currencies',
                'value' => json_encode(['CNY', 'USD', 'USDT', 'AUD']),
                'description' => '支持的货币列表',
                'type' => 'textarea',
                'options' => null,
                'group' => 'currency',
                'sort_order' => 3,
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'currency_symbols',
                'value' => json_encode([
                    'CNY' => '¥',
                    'USD' => '$',
                    'USDT' => '$',
                    'AUD' => 'A$'
                ]),
                'description' => '货币符号映射',
                'type' => 'textarea',
                'options' => null,
                'group' => 'currency',
                'sort_order' => 4,
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // 汇率API配置
            [
                'key' => 'exchange_rate_api_key',
                'value' => '',
                'description' => '汇率API密钥',
                'type' => 'text',
                'options' => null,
                'group' => 'exchange',
                'sort_order' => 1,
                'is_public' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'exchange_rate_api_url',
                'value' => 'https://api.exchangerate.host',
                'description' => '汇率API地址',
                'type' => 'text',
                'options' => null,
                'group' => 'exchange',
                'sort_order' => 2,
                'is_public' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'exchange_rate_update_interval',
                'value' => '3600',
                'description' => '汇率更新间隔（秒）',
                'type' => 'number',
                'options' => null,
                'group' => 'exchange',
                'sort_order' => 3,
                'is_public' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'exchange_rate_cache_time',
                'value' => '3600',
                'description' => '汇率缓存时间（秒）',
                'type' => 'number',
                'options' => null,
                'group' => 'exchange',
                'sort_order' => 4,
                'is_public' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // 其他系统配置
            [
                'key' => 'system_name',
                'value' => '独居客',
                'description' => '系统名称',
                'type' => 'text',
                'options' => null,
                'group' => 'general',
                'sort_order' => 1,
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'system_version',
                'value' => '1.0.0',
                'description' => '系统版本',
                'type' => 'text',
                'options' => null,
                'group' => 'general',
                'sort_order' => 2,
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'maintenance_mode',
                'value' => '0',
                'description' => '维护模式',
                'type' => 'switch',
                'options' => null,
                'group' => 'general',
                'sort_order' => 3,
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'maintenance_message',
                'value' => '系统维护中，请稍后再试',
                'description' => '维护模式消息',
                'type' => 'textarea',
                'options' => null,
                'group' => 'general',
                'sort_order' => 4,
                'is_public' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // 批量插入数据
        DB::table('system_configs')->insert($configs);

        $this->command->info('系统配置数据初始化完成！');
    }

    /**
     * 创建系统配置表
     */
    private function createSystemConfigsTable()
    {
        $sql = "
        CREATE TABLE `system_configs` (
          `id` bigint unsigned NOT NULL AUTO_INCREMENT,
          `key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置键',
          `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '配置值',
          `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '配置描述',
          `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'text' COMMENT '配置类型：text,textarea,select,switch,number',
          `options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '选项配置（JSON格式）',
          `group` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'general' COMMENT '配置分组',
          `sort_order` int DEFAULT '0' COMMENT '排序',
          `is_public` tinyint(1) DEFAULT '1' COMMENT '是否公开（前端可访问）',
          `created_at` timestamp NULL DEFAULT NULL,
          `updated_at` timestamp NULL DEFAULT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `system_configs_key_unique` (`key`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统配置表';
        ";

        DB::statement($sql);
        $this->command->info('系统配置表创建完成！');
    }
}
