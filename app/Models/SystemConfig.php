<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SystemConfig extends Model
{
    protected $fillable = [
        'key',
        'value',
        'description',
        'type',
        'options',
        'group',
        'sort_order',
        'is_public'
    ];

    protected $casts = [
        'options' => 'array',
        'is_public' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * 获取配置值
     *
     * @param string $key 配置键
     * @param mixed $default 默认值
     * @return mixed
     */
    public static function getConfig($key, $default = null)
    {
        $cacheKey = "system_config_{$key}";
        
        return Cache::remember($cacheKey, 3600, function () use ($key, $default) {
            $config = self::where('key', $key)->first();
            return $config ? $config->value : $default;
        });
    }

    /**
     * 设置配置值
     *
     * @param string $key 配置键
     * @param mixed $value 配置值
     * @param string $description 配置描述
     * @return bool
     */
    public static function setConfig($key, $value, $description = null)
    {
        $config = self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'description' => $description
            ]
        );

        // 清除缓存
        Cache::forget("system_config_{$key}");
        
        return $config;
    }

    /**
     * 获取分组配置
     *
     * @param string $group 分组名称
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getConfigsByGroup($group)
    {
        return self::where('group', $group)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * 获取所有公开配置
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getPublicConfigs()
    {
        return self::where('is_public', true)
            ->orderBy('group')
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * 批量设置配置
     *
     * @param array $configs 配置数组
     * @return bool
     */
    public static function setConfigs($configs)
    {
        foreach ($configs as $key => $value) {
            self::setConfig($key, $value);
        }
        
        return true;
    }

    /**
     * 获取货币配置
     *
     * @return array
     */
    public static function getCurrencyConfig()
    {
        return [
            'unit' => self::getConfig('currency_unit', 'CNY'),
            'symbol' => self::getConfig('currency_symbol', '¥'),
            'supported_currencies' => json_decode(self::getConfig('supported_currencies', '["CNY","USD","USDT","AUD"]'), true),
            'currency_symbols' => json_decode(self::getConfig('currency_symbols', '{"CNY":"¥","USD":"$","USDT":"$","AUD":"A$"}'), true)
        ];
    }

    /**
     * 获取汇率API配置
     *
     * @return array
     */
    public static function getExchangeRateConfig()
    {
        return [
            'api_key' => self::getConfig('exchange_rate_api_key', ''),
            'api_url' => self::getConfig('exchange_rate_api_url', 'https://api.exchangerate.host'),
            'update_interval' => (int)self::getConfig('exchange_rate_update_interval', 3600),
            'cache_time' => (int)self::getConfig('exchange_rate_cache_time', 3600)
        ];
    }

    /**
     * 清除所有配置缓存
     *
     * @return bool
     */
    public static function clearCache()
    {
        $configs = self::all();
        foreach ($configs as $config) {
            Cache::forget("system_config_{$config->key}");
        }
        
        return true;
    }
}
