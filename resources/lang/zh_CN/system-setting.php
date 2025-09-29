<?php
/**
 * The file was created by Assimon.
 *
 * @author    assimon<ashang@utf8.hk>
 * @copyright assimon<ashang@utf8.hk>
 * @link      http://utf8.hk/
 */

return [
    'labels' => [
        'SystemSetting' => '系统设置',
        'system_setting' => '系统设置',
        'base_setting' => '基本设置',
        'mail_setting' => '邮件服务',
        'order_push_setting' => '订单推送配置',
        'geetest' => '极验验证',
        'currency_setting' => '货币配置',
        'exchange_rate_setting' => '汇率API配置',
    ],

    'fields' => [
        'title' => '网站标题',
        'text_logo' => '文字LOGO',
        'img_logo' => '图片LOGO',
        'keywords' => '网站关键词',
        'description' => '网站描述',
        'notice' => '站点公告',
        'footer' => '页脚自定义代码',
        'manage_email' => '管理员邮箱',
        'is_open_anti_red' => '是否开启微信/QQ防红',
        'is_open_img_code' => '是否开启图形验证码',
        'is_open_search_pwd' => '是否开启查询密码',
        'is_open_google_translate' => '是否开启google翻译',
        'is_open_email_otp'=>"是否开启邮箱验证码",

        'is_open_server_jiang' => '是否开启server酱',
        'server_jiang_token' => 'server酱通讯token',
        'is_open_telegram_push' => '是否开启Telegram推送',
        'telegram_userid' => 'Telegram用户id',
        'telegram_bot_token' => 'Telegram通讯token',
		'is_open_bark_push' => '是否开启Bark推送',
		'is_open_bark_push_url' => '是否推送订单URL',
		'bark_server' => 'Bark服务器',
		'bark_token' => 'Bark通讯Token',
		'is_open_qywxbot_push' => '是否开启企业微信Bot推送',
		'qywxbot_key' => '企业微信Bot通讯Key',

        'template' => '站点模板',
        'language' => '站点语言',
        'order_expire_time' => '订单过期时间(分钟)',

        'driver' => '邮件驱动',
        'host' => 'smtp服务器地址',
        'port' => '端口',
        'username' => '账号',
        'password' => '密码',
        'encryption' => '协议',
        'from_address' => '发件地址',
        'from_name' => '发件名称',

        'geetest_id' => '极验id',
        'geetest_key' => '极验key',
        'is_open_geetest' => '是否开启极验',
        
        // 货币配置
        'currency_unit' => '默认货币单位',
        'currency_symbol' => '默认货币符号',
        'supported_currencies' => '支持的货币列表',
        'currency_symbols' => '货币符号映射',
        
        // 汇率API配置
        'exchange_rate_api_key' => '汇率API密钥',
        'exchange_rate_api_url' => '汇率API地址',
        'exchange_rate_update_interval' => '汇率更新间隔（秒）',
        'exchange_rate_cache_time' => '汇率缓存时间（秒）',
    ],
    'options' => [
    ],
    'help' => [
        'supported_currencies' => '请输入JSON格式的货币代码数组，例如：["CNY","USD","USDT","AUD"]',
        'currency_symbols' => '请输入JSON格式的货币符号映射，例如：{"CNY":"¥","USD":"$","USDT":"$","AUD":"A$"}',
        'exchange_rate_api_key' => '请输入exchangerate.host的API密钥，如果使用免费版本可以留空',
        'exchange_rate_update_interval' => '汇率数据更新间隔，建议设置为3600秒（1小时）',
        'exchange_rate_cache_time' => '汇率数据缓存时间，建议设置为3600秒（1小时）',
    ],
    'rule_messages' => [
        'save_system_setting_success' => '系统配置保存成功！',
        'change_reboot_php_worker' => '修改部分配置需要重启[supervisor]或php进程管理工具才会生效，例如邮件服务，server酱等。'
    ]
];
