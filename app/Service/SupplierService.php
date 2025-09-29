<?php

namespace App\Service;

use App\Models\Supplier;

class SupplierService
{
    public $method;
    protected $class;
    protected $config;
    protected $supplier_model;
    protected $supplier;

    public function __construct($method,$id = NULL,$supplier_model=NULL)
    {
        $this->method = $method;
        $this->class = '\\App\\Suppliers\\' . $this->method;
        if (!class_exists($this->class)) abort(500, 'gate is not found');
        if ($id) $supplier_model = Supplier::find($id)->toArray();
        $this->config = [];
        if(isset($supplier_model)){
            $this->config = $supplier_model['config'];
            $this->supplier_model = $supplier_model;
        }
        $this->supplier = new $this->class($this->config);
    }

    public function getGroupList(){
        return $this->supplier->getGroupList();
    }

    public function getGoodsList($group_id=0){
        return $this->supplier->getGoodsList($group_id);
    }

    public function validateGoods($goodsId, $num){
        return $this->supplier->validateGoods($goodsId, $num);
    }

    public function buyGoods($supplierOrderSn,$gmail,$supplierGoodsId, $num,$otherIpt=null){
        return $this->supplier->buyGoods($supplierOrderSn,$gmail,$supplierGoodsId, $num,$otherIpt=null);
    }

    public function form()
    {
        $form = $this->supplier->form();
        $keys = array_keys($form);
        foreach ($keys as $key) {
            if (isset($this->config[$key])) $form[$key]['value'] = $this->config[$key];
        }
        return $form;
    }
}