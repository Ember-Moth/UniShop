<?php

namespace App\Suppliers\Base;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

abstract class BaseSupplier
{
    protected $config;
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function form()
    {
        return [
            'agent_id' => [
                'label' => '代理商号',
                'description' => '',
                'type' => 'input',
            ],
            'key' => [
                'label' => 'KEY',
                'description' => '密钥Key',
                'type' => 'input',
            ],
            'api_url' => [
                'label' => '接口地址',
                'description' => '',
                'type' => 'input',
            ],
        ];
    }
    abstract public function getBalance();
    abstract public function getGroupList();
    abstract public function getGoodsList($group_id=0);

    abstract public function validateGoods($supplierGoodsId,$num);

    abstract public function buyGoods($supplierOrderSn,$email,$supplierGoodsId,$num,$otherIpt=null);

    /**
     * 请求api接口
     * @param $params
     * @param $api
     * @return array|mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getRequestApi($params, $api)
    {
        $client = new Client();
        $headers = [
            'Accept'     => 'application/json',
            //'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
            'Content-Type' => 'application/json;charset=utf-8'
        ];
        $response = $client->request('POST', $api, [
            'headers' => $headers,
            //'form_params' => $params,
            'json' => $params,
            'verify' => false, // 忽略SSL证书校验
        ]);
        $res = $response->getBody()->getContents();
        $api_msg = '调用Supplier返回的原始结果：' . $res . "，请求参数为：" . json_encode($params);
        $api_msg .= "，请求接口为：" . $api;
        Log::info($api_msg);

        $responseArray = json_decode($res, true);
        if (!is_array($responseArray)) {
            Log::error("请求接口返回错误:" . $res);
            return '请求接口返回错误';
        }
        return $responseArray;
    }

    /**
     * 生成签名
     * @param $params
     * @return string
     */
    public function createSign($params)
    {
        //生成签名
        return generate_signature($params, $this->config['key']);
    }
}