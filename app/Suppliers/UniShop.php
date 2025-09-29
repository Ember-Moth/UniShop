<?php

namespace App\Suppliers;

use App\Suppliers\Base\BaseSupplier;

class UniShop extends BaseSupplier
{
    public function getBalance(){
        $params = ['agent_id'=>$this->config['agent_id']];
        $params['sign'] = $this->createSign($params);
        return $this->getRequestApi($params,$this->config['api_url'].'/api/v1/agent/balance');
    }
    public function getGroupList(){
        $params = ['agent_id'=>$this->config['agent_id']];
        $params['sign'] = $this->createSign($params);
        return $this->getRequestApi($params,$this->config['api_url'].'/api/v1/agent/group-list');
    }
    public function getGoodsList($group_id=0)
    {
        $params = ['agent_id'=>$this->config['agent_id']];
        if(!empty($group_id)){
            $params['group_id'] = $group_id;
        }
        $params['sign'] = $this->createSign($params);
        return $this->getRequestApi($params,$this->config['api_url'].'/api/v1/agent/goods-list');
    }

    public function buyGoods($supplierOrderSn,$gmail,$supplierGoodsId, $num,$otherIpt=null)
    {
        $params = ['agent_id'=>$this->config['agent_id']];
        $params['supplier_order_sn'] = $supplierOrderSn;
        $params['email'] = $gmail;
        $params['gid'] = $supplierGoodsId;
        $params['buy_amount'] = $num;
        $params['payway'] = 0;
        $params['other_ipt'] = $otherIpt;
        $params['sign'] = $this->createSign($params);
        return $this->getRequestApi($params,$this->config['api_url'].'/api/v1/agent/buy-goods');
    }

    public function validateGoods($supplierGoodsId,$num)
    {
        $params = ['agent_id'=>$this->config['agent_id']];
        $params['gid'] = $supplierGoodsId;
        $params['buy_amount'] = $num;
        $params['sign'] = $this->createSign($params);
        return $this->getRequestApi($params,$this->config['api_url'].'/api/v1/agent/validate-goods');
    }
}