<?php

namespace App\Admin\Forms;

use App\Models\BaseModel;
use App\Models\SystemConfig;
use Dcat\Admin\Widgets\Form;
use Illuminate\Support\Facades\Cache;

class SystemSetting extends Form
{
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        try {
            // 处理系统配置
            $systemConfigs = [];
            $currencyConfigs = [];
            $exchangeConfigs = [];
            
            // 分离不同类型的配置
            foreach ($input as $key => $value) {
                if (strpos($key, 'currency_') === 0) {
                    $currencyConfigs[$key] = $value;
                } elseif (strpos($key, 'exchange_') === 0) {
                    $exchangeConfigs[$key] = $value;
                } else {
                    $systemConfigs[$key] = $value;
                }
            }
            
            // 保存到数据库
            if (!empty($currencyConfigs)) {
                try {
                    SystemConfig::setConfigs($currencyConfigs);
                } catch (\Exception $e) {
                    \Log::error('Failed to save currency configs: ' . $e->getMessage());
                    return $this->response()->error('保存货币配置失败：' . $e->getMessage());
                }
            }
            
            if (!empty($exchangeConfigs)) {
                try {
                    SystemConfig::setConfigs($exchangeConfigs);
                } catch (\Exception $e) {
                    \Log::error('Failed to save exchange configs: ' . $e->getMessage());
                    return $this->response()->error('保存汇率配置失败：' . $e->getMessage());
                }
            }
            
            // 保存原有配置到缓存
            Cache::put('system-setting', $systemConfigs);
            
            return $this
                ->response()
                ->success(admin_trans('system-setting.rule_messages.save_system_setting_success'));
                
        } catch (\Exception $e) {
            \Log::error('System setting save error: ' . $e->getMessage());
            return $this->response()->error('保存系统配置失败：' . $e->getMessage());
        }
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->tab(admin_trans('system-setting.labels.base_setting'), function () {
            $this->text('title', admin_trans('system-setting.fields.title'))->required();
            $this->image('img_logo', admin_trans('system-setting.fields.img_logo'));
            $this->text('text_logo', admin_trans('system-setting.fields.text_logo'));
            $this->text('keywords', admin_trans('system-setting.fields.keywords'));
            $this->textarea('description', admin_trans('system-setting.fields.description'));
            $this->select('template', admin_trans('system-setting.fields.template'))
                ->options(config('dujiaoka.templates'))
                ->required();
            $this->select('language', admin_trans('system-setting.fields.language'))
                ->options(config('dujiaoka.language'))
                ->required();
            $this->text('manage_email', admin_trans('system-setting.fields.manage_email'));
            $this->number('order_expire_time', admin_trans('system-setting.fields.order_expire_time'))
                ->default(5)
                ->required();
            $this->switch('is_open_anti_red', admin_trans('system-setting.fields.is_open_anti_red'))
                ->default(BaseModel::STATUS_CLOSE);
            $this->switch('is_open_img_code', admin_trans('system-setting.fields.is_open_img_code'))
                ->default(BaseModel::STATUS_CLOSE);
            $this->switch('is_open_search_pwd', admin_trans('system-setting.fields.is_open_search_pwd'))
                ->default(BaseModel::STATUS_CLOSE);
            $this->switch('is_open_google_translate', admin_trans('system-setting.fields.is_open_google_translate'))
                ->default(BaseModel::STATUS_CLOSE);
            $this->switch('is_open_email_otp', admin_trans('system-setting.fields.is_open_email_otp'))
                ->default(BaseModel::STATUS_CLOSE);
            $this->editor('notice', admin_trans('system-setting.fields.notice'));
            $this->textarea('footer', admin_trans('system-setting.fields.footer'));
        });
        $this->tab(admin_trans('system-setting.labels.order_push_setting'), function () {
            $this->switch('is_open_server_jiang', admin_trans('system-setting.fields.is_open_server_jiang'))
                ->default(BaseModel::STATUS_CLOSE);
            $this->text('server_jiang_token', admin_trans('system-setting.fields.server_jiang_token'));
            $this->switch('is_open_telegram_push', admin_trans('system-setting.fields.is_open_telegram_push'))
                ->default(BaseModel::STATUS_CLOSE);
            $this->text('telegram_bot_token', admin_trans('system-setting.fields.telegram_bot_token'));
            $this->text('telegram_userid', admin_trans('system-setting.fields.telegram_userid'));
            $this->switch('is_open_bark_push', admin_trans('system-setting.fields.is_open_bark_push'))
                ->default(BaseModel::STATUS_CLOSE);
            $this->switch('is_open_bark_push_url', admin_trans('system-setting.fields.is_open_bark_push_url'))
                ->default(BaseModel::STATUS_CLOSE);
            $this->text('bark_server', admin_trans('system-setting.fields.bark_server'));
            $this->text('bark_token', admin_trans('system-setting.fields.bark_token'));
            $this->switch('is_open_qywxbot_push', admin_trans('system-setting.fields.is_open_qywxbot_push'))
                ->default(BaseModel::STATUS_CLOSE);
            $this->text('qywxbot_key', admin_trans('system-setting.fields.qywxbot_key'));
        });
        $this->tab(admin_trans('system-setting.labels.mail_setting'), function () {
            $this->text('driver', admin_trans('system-setting.fields.driver'))->default('smtp')->required();
            $this->text('host', admin_trans('system-setting.fields.host'));
            $this->text('port', admin_trans('system-setting.fields.port'))->default(587);
            $this->text('username', admin_trans('system-setting.fields.username'));
            $this->text('password', admin_trans('system-setting.fields.password'));
            $this->text('encryption', admin_trans('system-setting.fields.encryption'));
            $this->text('from_address', admin_trans('system-setting.fields.from_address'));
            $this->text('from_name', admin_trans('system-setting.fields.from_name'));
        });
        $this->tab(admin_trans('system-setting.labels.geetest'), function () {
            $this->text('geetest_id', admin_trans('system-setting.fields.geetest_id'));
            $this->text('geetest_key', admin_trans('system-setting.fields.geetest_key'));
            $this->switch('is_open_geetest', admin_trans('system-setting.fields.is_open_geetest'))->default(BaseModel::STATUS_CLOSE);
        });
        
        $this->tab(admin_trans('system-setting.labels.currency_setting'), function () {
            // 安全获取配置值，避免错误
            $currencyUnit = 'CNY';
            $currencySymbol = '¥';
            $supportedCurrencies = '["CNY","USD","USDT","AUD"]';
            $currencySymbols = '{"CNY":"¥","USD":"$","USDT":"$","AUD":"A$"}';
            
            try {
                $currencyUnit = SystemConfig::getConfig('currency_unit', 'CNY');
                $currencySymbol = SystemConfig::getConfig('currency_symbol', '¥');
                $supportedCurrencies = SystemConfig::getConfig('supported_currencies', '["CNY","USD","USDT","AUD"]');
                $currencySymbols = SystemConfig::getConfig('currency_symbols', '{"CNY":"¥","USD":"$","USDT":"$","AUD":"A$"}');
            } catch (\Exception $e) {
                // 如果获取配置失败，使用默认值
                \Log::warning('Failed to get currency configs: ' . $e->getMessage());
            }
            
            $this->select('currency_unit', admin_trans('system-setting.fields.currency_unit'))
                ->options([
                    'CNY' => '人民币 (CNY)',
                    'USD' => '美元 (USD)',
                    'USDT' => 'USDT',
                    'AUD' => '澳元 (AUD)',
                    'EUR' => '欧元 (EUR)',
                    'JPY' => '日元 (JPY)',
                    'GBP' => '英镑 (GBP)'
                ])
                ->default($currencyUnit)
                ->required();
                
            $this->select('currency_symbol', admin_trans('system-setting.fields.currency_symbol'))
                ->options([
                    '¥' => '¥ (人民币)',
                    '$' => '$ (美元)',
                    '€' => '€ (欧元)',
                    '£' => '£ (英镑)',
                    'A$' => 'A$ (澳元)'
                ])
                ->default($currencySymbol)
                ->required();
                
            // 安全创建货币配置字段
            $field5 = $this->textarea('supported_currencies', admin_trans('system-setting.fields.supported_currencies') ?: '支持的货币列表');
            if ($field5) {
                $field5->default($supportedCurrencies);
                $helpText5 = admin_trans('system-setting.help.supported_currencies') ?: '请输入JSON格式的货币代码数组，例如：["CNY","USD","USDT","AUD"]';
                $field5->help($helpText5);
            }
                
            $field6 = $this->textarea('currency_symbols', admin_trans('system-setting.fields.currency_symbols') ?: '货币符号映射');
            if ($field6) {
                $field6->default($currencySymbols);
                $helpText6 = admin_trans('system-setting.help.currency_symbols') ?: '请输入JSON格式的货币符号映射，例如：{"CNY":"¥","USD":"$","USDT":"$","AUD":"A$"}';
                $field6->help($helpText6);
            }
        });
        
        $this->tab(admin_trans('system-setting.labels.exchange_rate_setting'), function () {
            // 安全获取配置值，避免错误
            $apiKey = '';
            $apiUrl = 'https://api.exchangerate.host';
            $updateInterval = 3600;
            $cacheTime = 3600;
            
            try {
                $apiKey = SystemConfig::getConfig('exchange_rate_api_key', '');
                $apiUrl = SystemConfig::getConfig('exchange_rate_api_url', 'https://api.exchangerate.host');
                $updateInterval = SystemConfig::getConfig('exchange_rate_update_interval', 3600);
                $cacheTime = SystemConfig::getConfig('exchange_rate_cache_time', 3600);
            } catch (\Exception $e) {
                // 如果获取配置失败，使用默认值
                \Log::warning('Failed to get exchange rate configs: ' . $e->getMessage());
            }
            
            // 安全创建表单字段
            $field1 = $this->text('exchange_rate_api_key', admin_trans('system-setting.fields.exchange_rate_api_key') ?: '汇率API密钥');
            if ($field1) {
                $field1->default($apiKey);
                $helpText1 = admin_trans('system-setting.help.exchange_rate_api_key') ?: '请输入exchangerate.host的API密钥，如果使用免费版本可以留空';
                $field1->help($helpText1);
            }
                
            $field2 = $this->text('exchange_rate_api_url', admin_trans('system-setting.fields.exchange_rate_api_url') ?: '汇率API地址');
            if ($field2) {
                $field2->default($apiUrl)->required();
            }
                
            $field3 = $this->number('exchange_rate_update_interval', admin_trans('system-setting.fields.exchange_rate_update_interval') ?: '汇率更新间隔（秒）');
            if ($field3) {
                $field3->default($updateInterval)->min(60);
                $helpText3 = admin_trans('system-setting.help.exchange_rate_update_interval') ?: '汇率数据更新间隔，建议设置为3600秒（1小时）';
                $field3->help($helpText3);
            }
                
            $field4 = $this->number('exchange_rate_cache_time', admin_trans('system-setting.fields.exchange_rate_cache_time') ?: '汇率缓存时间（秒）');
            if ($field4) {
                $field4->default($cacheTime)->min(60);
                $helpText4 = admin_trans('system-setting.help.exchange_rate_cache_time') ?: '汇率数据缓存时间，建议设置为3600秒（1小时）';
                $field4->help($helpText4);
            }
        });
        // 暂时注释掉确认对话框，避免阻止表单提交
        // $this->confirm(
        //     admin_trans('dujiaoka.warning_title'),
        //     admin_trans('system-setting.rule_messages.change_reboot_php_worker')
        // );
    }

    public function default()
    {
        return Cache::get('system-setting');
    }

    /**
     * 表单提交前的JavaScript验证
     */
    public function script()
    {
        return <<<JS
        // 确保表单可以正常提交
        $(document).ready(function() {
            console.log('SystemSetting form ready');
            
            // 移除可能阻止提交的事件
            $('form').off('submit.prevent');
            
            // 确保提交按钮可点击
            $('button[type="submit"]').off('click.prevent').prop('disabled', false);
            
            // 添加调试信息
            $('button[type="submit"]').on('click', function() {
                console.log('Submit button clicked');
            });
            
            // 表单提交事件
            $('form').on('submit', function(e) {
                console.log('Form submitting...');
                return true; // 允许提交
            });
        });
        JS;
    }

}
