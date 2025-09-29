<?php

namespace App\Services;

use App\Models\SystemConfig;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExchangeRateService
{
    /**
     * 获取汇率
     *
     * @param string $from 源货币
     * @param string $to 目标货币
     * @return float|null
     */
    public static function getExchangeRate($from, $to)
    {
        $cacheKey = "exchange_rate_{$from}_{$to}";
        $config = SystemConfig::getExchangeRateConfig();
        
        return Cache::remember($cacheKey, $config['cache_time'], function () use ($from, $to, $config) {
            try {
                $url = $config['api_url'] . '/convert';
                $params = [
                    'from' => strtoupper($from),
                    'to' => strtoupper($to),
                    'amount' => 1
                ];
                
                // 如果有API密钥，添加到请求中
                if (!empty($config['api_key'])) {
                    $params['access_key'] = $config['api_key'];
                }
                
                $response = Http::timeout(10)->get($url, $params);
                
                if ($response->successful()) {
                    $data = $response->json();
                    
                    if (isset($data['success']) && $data['success'] === true) {
                        return $data['result'];
                    }
                }
                
                Log::warning('汇率API请求失败', [
                    'from' => $from,
                    'to' => $to,
                    'response' => $response->body()
                ]);
                
                return null;
            } catch (\Exception $e) {
                Log::error('汇率API请求异常', [
                    'from' => $from,
                    'to' => $to,
                    'error' => $e->getMessage()
                ]);
                
                return null;
            }
        });
    }

    /**
     * 货币转换
     *
     * @param float $amount 金额
     * @param string $from 源货币
     * @param string $to 目标货币
     * @return float|null
     */
    public static function convert($amount, $from, $to)
    {
        if ($from === $to) {
            return $amount;
        }
        
        $rate = self::getExchangeRate($from, $to);
        
        if ($rate !== null) {
            return $amount * $rate;
        }
        
        return null;
    }

    /**
     * 获取支持的货币列表
     *
     * @return array
     */
    public static function getSupportedCurrencies()
    {
        $config = SystemConfig::getCurrencyConfig();
        return $config['supported_currencies'] ?? ['CNY', 'USD', 'USDT', 'AUD'];
    }

    /**
     * 获取货币符号
     *
     * @param string $currency 货币代码
     * @return string
     */
    public static function getCurrencySymbol($currency)
    {
        $config = SystemConfig::getCurrencyConfig();
        $symbols = $config['currency_symbols'] ?? [];
        
        return $symbols[strtoupper($currency)] ?? strtoupper($currency);
    }

    /**
     * 格式化货币显示
     *
     * @param float $amount 金额
     * @param string $currency 货币代码
     * @param int $decimals 小数位数
     * @return string
     */
    public static function formatCurrency($amount, $currency, $decimals = 2)
    {
        $symbol = self::getCurrencySymbol($currency);
        $formattedAmount = number_format($amount, $decimals);
        
        // 根据货币调整显示格式
        switch (strtoupper($currency)) {
            case 'CNY':
            case 'USD':
            case 'AUD':
                return $symbol . $formattedAmount;
            case 'EUR':
                return $formattedAmount . ' ' . $symbol;
            case 'JPY':
                return $symbol . number_format($amount, 0);
            default:
                return $symbol . $formattedAmount;
        }
    }

    /**
     * 批量获取汇率
     *
     * @param string $baseCurrency 基础货币
     * @param array $targetCurrencies 目标货币列表
     * @return array
     */
    public static function getBulkExchangeRates($baseCurrency, $targetCurrencies)
    {
        $rates = [];
        
        foreach ($targetCurrencies as $currency) {
            if ($currency !== $baseCurrency) {
                $rate = self::getExchangeRate($baseCurrency, $currency);
                if ($rate !== null) {
                    $rates[$currency] = $rate;
                }
            }
        }
        
        return $rates;
    }

    /**
     * 清除汇率缓存
     *
     * @param string|null $from 源货币
     * @param string|null $to 目标货币
     * @return bool
     */
    public static function clearCache($from = null, $to = null)
    {
        if ($from && $to) {
            Cache::forget("exchange_rate_{$from}_{$to}");
        } else {
            // 清除所有汇率缓存
            $supportedCurrencies = self::getSupportedCurrencies();
            foreach ($supportedCurrencies as $currency1) {
                foreach ($supportedCurrencies as $currency2) {
                    if ($currency1 !== $currency2) {
                        Cache::forget("exchange_rate_{$currency1}_{$currency2}");
                    }
                }
            }
        }
        
        return true;
    }
}
