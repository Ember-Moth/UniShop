<?php

/**
 * Dujiaoka 支付系统测试示例
 * 
 * 此文件用于测试支付系统的各项功能
 * 请根据实际情况修改配置参数
 */

require_once __DIR__ . '/vendor/autoload.php';

use App\Payments\PaymentException;
use App\Service\PaymentService;

// 测试配置
class PaymentTest
{
    /**
     * 测试支付方式支持
     */
    public function testSupportedPayments()
    {
        echo "=== 测试支持的支付方式 ===\n";
        
        $supportedPayments = PaymentService::getSupportedPayments();
        echo "支持的支付方式: " . implode(', ', $supportedPayments) . "\n\n";
        
        foreach ($supportedPayments as $paymentType) {
            $info = PaymentService::getPaymentInfo($paymentType);
            if ($info) {
                echo "支付方式: {$info['name']}\n";
                echo "描述: {$info['description']}\n";
                echo "类型: {$info['type']}\n";
                echo "支持货币: " . implode(', ', $info['supported_currencies']) . "\n";
                echo "---\n";
            }
        }
    }

    /**
     * 测试支付配置表单
     */
    public function testPaymentForms()
    {
        echo "=== 测试支付配置表单 ===\n";
        
        $paymentTypes = ['alipay_f2f', 'epay', 'stripe_checkout'];
        
        foreach ($paymentTypes as $paymentType) {
            try {
                $form = PaymentService::getPaymentForm($paymentType);
                echo "支付方式: {$paymentType}\n";
                echo "配置字段数量: " . count($form) . "\n";
                foreach ($form as $field => $config) {
                    echo "  - {$field}: {$config['label']} ({$config['type']})\n";
                }
                echo "---\n";
            } catch (PaymentException $e) {
                echo "获取 {$paymentType} 配置表单失败: " . $e->getMessage() . "\n";
            }
        }
    }

    /**
     * 测试EPay支付（模拟）
     */
    public function testEPayPayment()
    {
        echo "=== 测试EPay支付 ===\n";
        
        // EPay配置
        $config = [
            'url' => 'https://epay.example.com',
            'pid' => '1000',
            'key' => 'test_key_123456'
        ];
        
        // 订单信息
        $order = [
            'trade_no' => 'TEST_ORDER_' . time(),
            'total_amount' => 10000, // 100元
            'user_id' => 1,
            'notify_url' => 'https://your-domain.com/payment/notify',
            'return_url' => 'https://your-domain.com/payment/return'
        ];
        
        try {
            $result = PaymentService::createPayment('epay', $config, $order);
            echo "支付创建成功\n";
            echo "返回类型: " . $result['type'] . "\n";
            echo "支付URL: " . $result['data'] . "\n";
        } catch (PaymentException $e) {
            echo "支付创建失败: " . $e->getMessage() . "\n";
        }
        
        echo "\n";
    }

    /**
     * 测试支付回调处理
     */
    public function testPaymentNotify()
    {
        echo "=== 测试支付回调处理 ===\n";
        
        // EPay配置
        $config = [
            'url' => 'https://epay.example.com',
            'pid' => '1000',
            'key' => 'test_key_123456'
        ];
        
        // 模拟回调参数
        $params = [
            'out_trade_no' => 'TEST_ORDER_' . time(),
            'trade_no' => 'EPAY_' . time(),
            'money' => '100.00',
            'name' => 'TEST_ORDER_' . time(),
            'sign' => 'test_signature'
        ];
        
        try {
            $result = PaymentService::handleNotify('epay', $config, $params);
            if ($result) {
                echo "回调处理成功\n";
                echo "订单号: " . $result['trade_no'] . "\n";
                echo "回调号: " . $result['callback_no'] . "\n";
            } else {
                echo "回调处理失败\n";
            }
        } catch (PaymentException $e) {
            echo "回调处理异常: " . $e->getMessage() . "\n";
        }
        
        echo "\n";
    }

    /**
     * 测试配置验证
     */
    public function testConfigValidation()
    {
        echo "=== 测试配置验证 ===\n";
        
        // 测试有效配置
        $validConfig = [
            'url' => 'https://epay.example.com',
            'pid' => '1000',
            'key' => 'test_key_123456'
        ];
        
        $isValid = PaymentService::validateConfig('epay', $validConfig);
        echo "有效配置验证结果: " . ($isValid ? '通过' : '失败') . "\n";
        
        // 测试无效配置
        $invalidConfig = [
            'url' => 'https://epay.example.com',
            // 缺少必需的pid和key字段
        ];
        
        $isValid = PaymentService::validateConfig('epay', $invalidConfig);
        echo "无效配置验证结果: " . ($isValid ? '通过' : '失败') . "\n";
        
        echo "\n";
    }

    /**
     * 测试异常处理
     */
    public function testExceptionHandling()
    {
        echo "=== 测试异常处理 ===\n";
        
        // 测试不支持的支付方式
        try {
            PaymentService::createPayment('unsupported_payment', [], []);
        } catch (PaymentException $e) {
            echo "不支持的支付方式异常: " . $e->getMessage() . "\n";
            echo "异常类型: " . $e->getErrorType() . "\n";
        }
        
        // 测试配置错误
        try {
            PaymentService::createPayment('epay', [], []);
        } catch (PaymentException $e) {
            echo "配置错误异常: " . $e->getMessage() . "\n";
            echo "异常类型: " . $e->getErrorType() . "\n";
        }
        
        echo "\n";
    }

    /**
     * 运行所有测试
     */
    public function runAllTests()
    {
        echo "开始支付系统测试...\n\n";
        
        $this->testSupportedPayments();
        $this->testPaymentForms();
        $this->testEPayPayment();
        $this->testPaymentNotify();
        $this->testConfigValidation();
        $this->testExceptionHandling();
        
        echo "支付系统测试完成！\n";
    }
}

// 运行测试（需要Laravel环境）
if (defined('LARAVEL_START')) {
    $test = new PaymentTest();
    $test->runAllTests();
} else {
    echo "请在Laravel环境中运行此测试文件\n";
    echo "或者使用: php artisan tinker\n";
    echo "然后在tinker中运行测试代码\n";
}

/**
 * 在Laravel Tinker中运行的测试代码示例：
 * 
 * // 测试支持的支付方式
 * PaymentService::getSupportedPayments();
 * 
 * // 测试支付配置表单
 * PaymentService::getPaymentForm('epay');
 * 
 * // 测试支付创建
 * $config = ['url' => 'https://epay.example.com', 'pid' => '1000', 'key' => 'test_key'];
 * $order = ['trade_no' => 'TEST_ORDER_' . time(), 'total_amount' => 10000, 'user_id' => 1, 'notify_url' => 'https://example.com/notify', 'return_url' => 'https://example.com/return'];
 * PaymentService::createPayment('epay', $config, $order);
 * 
 * // 测试配置验证
 * PaymentService::validateConfig('epay', $config);
 * 
 * // 测试支付方式信息
 * PaymentService::getPaymentInfo('epay');
 */
