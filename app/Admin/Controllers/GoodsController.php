<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\BatchRestore;
use App\Admin\Actions\Post\Restore;
use App\Admin\Repositories\Goods;
use App\Models\Carmis;
use App\Models\Coupon;
use App\Models\GoodsGroup as GoodsGroupModel;
use App\Models\Supplier;
use App\Service\SupplierService;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\Goods as GoodsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class GoodsController extends AdminController
{


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Goods(['group', 'coupon']), function (Grid $grid) {
            $grid->model()->orderBy('id', 'DESC');
            $grid->column('id')->sortable();
            $grid->column('picture')->image('', 100, 100);
            $grid->column('gd_name');
            $grid->column('gd_description');
            $grid->column('gd_keywords');
            $grid->column('group.gp_name', admin_trans('goods.fields.group_id'));
            $grid->column('type')
                ->using(GoodsModel::getGoodsTypeMap())
                ->label([
                    GoodsModel::AUTOMATIC_DELIVERY => Admin::color()->success(),
                    GoodsModel::MANUAL_PROCESSING => Admin::color()->info(),
                ]);
            $grid->column('retail_price');
            $grid->column('actual_price')->sortable();
            $grid->column('in_stock')->display(function () {
                // 如果为自动发货，则加载库存卡密
                if ($this->type == GoodsModel::AUTOMATIC_DELIVERY) {
                    return Carmis::query()->where('goods_id', $this->id)
                        ->where('status', Carmis::STATUS_UNSOLD)
                        ->count();
                } else {
                    return $this->in_stock;
                }
            });
            $grid->column('sales_volume');
            $grid->column('ord')->editable()->sortable();
            $grid->column('is_open')->switch();
            $grid->column('created_at')->sortable();
            $grid->column('updated_at');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('gd_name');
                $filter->equal('type')->select(GoodsModel::getGoodsTypeMap());
                $filter->equal('group_id')->select(GoodsGroupModel::query()->pluck('gp_name', 'id'));
                $filter->scope(admin_trans('dujiaoka.trashed'))->onlyTrashed();
                $filter->equal('coupon.coupons_id', admin_trans('goods.fields.coupon_id'))->select(
                    Coupon::query()->pluck('coupon', 'id')
                );
            });
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                if (request('_scope_') == admin_trans('dujiaoka.trashed')) {
                    $actions->append(new Restore(GoodsModel::class));
                }
            });
            $grid->batchActions(function (Grid\Tools\BatchActions $batch) {
                if (request('_scope_') == admin_trans('dujiaoka.trashed')) {
                    $batch->add(new BatchRestore(GoodsModel::class));
                }
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Goods(), function (Show $show) {
            $show->id('id');
            $show->field('gd_name');
            $show->field('gd_description');
            $show->field('gd_keywords');
            $show->field('picture')->image();
            $show->field('retail_price');
            $show->field('actual_price');
            $show->field('in_stock');
            $show->field('ord');
            $show->field('sales_volume');
            $show->field('type')->as(function ($type) {
                if ($type == GoodsModel::AUTOMATIC_DELIVERY) {
                    return admin_trans('goods.fields.automatic_delivery');
                } else {
                    return admin_trans('goods.fields.manual_processing');
                }
            });
            $show->field('is_open')->as(function ($isOpen) {
                if ($isOpen == GoodsGroupModel::STATUS_OPEN) {
                    return admin_trans('dujiaoka.status_open');
                } else {
                    return admin_trans('dujiaoka.status_close');
                }
            });
            $show->wholesale_price_cnf()->unescape()->as(function ($wholesalePriceCnf) {
                return  "<textarea class=\"form-control field_wholesale_price_cnf _normal_\"  rows=\"10\" cols=\"30\">" . $wholesalePriceCnf . "</textarea>";
            });
            $show->other_ipu_cnf()->unescape()->as(function ($otherIpuCnf) {
                return  "<textarea class=\"form-control field_wholesale_price_cnf _normal_\"  rows=\"10\" cols=\"30\">" . $otherIpuCnf . "</textarea>";
            });
            $show->api_hook()->unescape()->as(function ($apiHook) {
                return  "<textarea class=\"form-control field_wholesale_price_cnf _normal_\"  rows=\"10\" cols=\"30\">" . $apiHook . "</textarea>";
            });;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Goods(), function (Form $form) {
            $form->display('id');
            $form->text('gd_name')->required();
            $form->text('gd_description')->required();
            $form->text('gd_keywords')->required();
            $form->select('group_id')->options(
                GoodsGroupModel::query()->pluck('gp_name', 'id')
            )->required();
            $form->image('picture')->autoUpload()->uniqueName()->help(admin_trans('goods.helps.picture'));

            $supplierIdSelect = $form->select('supplier_id','货源')->options(
                Supplier::getAdminSuppliers()
            )->default(0);
            if($form->isCreating()){
                $supplierIdSelect->load('supplier_group_id','/goods/supplier-group')->when(0, function ($form) {
                    $form->radio('type')->options(GoodsModel::getGoodsTypeMap())->default(GoodsModel::AUTOMATIC_DELIVERY)->required();
                })->when(">",0,function ($form){
                    $form->text('supplier_group_name','供应商商品分组名称')->readonly()->display(false);
                    $form->text('supplier_goods_name','货源商品名称')->readonly()->display(false);
                    $form->select('supplier_group_id','供应商商品分组')->load('supplier_goods_id','/goods/supplier-goods');
                    $form->select('supplier_goods_id','货源商品')->script("
                    $('select[name=\"supplier_goods_id\"]').on('change',function(e){
                        var supplier_goods_id = $(this).val();
                        var supplier_id = $('select[name=\"supplier_id\"]').val();
                        var supplier_group_id = $('select[name=\"supplier_group_id\"]').val();
                        $.ajax({
                            url:'/admin/goods/supplier-goods-data',
                            method:'GET',
                            data:{supplier_goods_id,supplier_id,supplier_group_id},
                            success:(res)=>{
                                console.log('success',res);
                                $('input[name=\"gd_name\"]').val(res.goods_name);
                                $('input[name=\"gd_description\"]').val(res.goods_description);
                                $('input[name=\"gd_keywords\"]').val(res.goods_keywords);
                                $('input[name=\"actual_price\"]').val(res.price);
                                $('input[name=\"supplier_price\"]').val(res.price);
                                $('input[name=\"in_stock\"]').val(res.in_stock);
                                $('textarea[name=\"other_ipu_cnf\"]').val(res.other_ipu_cnf);
                                $('textarea[name=\"other_ipu_cnf\"]').attr(\"readonly\",true);
                                $('input[name=\"supplier_goods_name\"]').val(res.goods_name);
                                $('input[name=\"supplier_group_name\"]').val($('select[name=\"supplier_group_id\"] option:selected').text());
                                debugger;
                            },
                            fail:(err)=>{
                                console.log('err',err);
                            }
                        });
                    })
                    ");

                    $form->currency('supplier_price','供应商价格')->readonly();
                    $form->radio('supplier_price_type','供应商加价模式')->options(GoodsModel::getSupplierPriceTypeMap())->default(GoodsModel::SUPPLIER_PRICE_TYPE_FIXED)->required();
                    $form->currency('supplier_price_type_rule','供应商加价规则');
                });
                admin_js(['@admin/my/js/admin_goods_form.js']);
            }
            if($form->isEditing()){
                $supplierIdSelect->readonly();
                $supplierIdSelect->when(">",0,function($form){
                    $form->text('supplier_group_name','供应商商品分组')->readonly();
                    $form->text('supplier_goods_name','货源商品')->readonly();
                    $form->currency('supplier_price','供应商价格');
                    $form->radio('supplier_price_type','供应商加价模式')->options(GoodsModel::getSupplierPriceTypeMap())->default(GoodsModel::SUPPLIER_PRICE_TYPE_FIXED);
                    $form->currency('supplier_price_type_rule','供应商加价规则');
                });
                admin_js(['@admin/my/js/admin_goods_form2.js']);
            }


            $form->currency('retail_price')->default(0)->help(admin_trans('goods.helps.retail_price'));
            $form->currency('actual_price')->default(0)->required();
            $form->number('in_stock')->help(admin_trans('goods.helps.in_stock'));
            $form->number('sales_volume');
            $form->number('buy_limit_num')->help(admin_trans('goods.helps.buy_limit_num'));
            $form->textarea('other_ipu_cnf')->help(admin_trans('goods.helps.other_ipu_cnf'));
            $form->editor('buy_prompt');
            $form->editor('description');

            $form->textarea('wholesale_price_cnf')->help(admin_trans('goods.helps.wholesale_price_cnf'));
            $form->textarea('api_hook');
            $form->number('ord')->default(1)->help(admin_trans('dujiaoka.ord'));
            $form->switch('is_open')->default(GoodsModel::STATUS_OPEN);


            $form->submitted(function (Form $form) {
                $arr = explode('-',$form->supplier_group_id);
                if(count($arr)==2){
                    $form->supplier_group_id = $arr[1];
                }else{
                    $form->supplier_group_id = 0;
                }
            });
        });
    }


    public function supplierGoodsGroups(Request $request){
        $supplierId = $request->get('q');

        $supplier = Supplier::query()->where('id', $supplierId)->first();
        cache()->put("current_supplier_id",$supplierId);
        if($supplier){
            $supplierService = new SupplierService($supplier['method'],$supplierId);
            $gs = $supplierService->getGroupList();
            $gs = $gs['data'];
            $arr = [];
            foreach ($gs as $k=>$v){
                $arr[] = ['id'=>$v['group_id'],'text'=>$v['group_name']];
            }
            return $arr;
        }

        return [];

    }

    public function supplierGoods(Request $request){
        $q = $request->get('q');
        $supplierId=cache()->get("current_supplier_id");
        $groupId = $q;


        $supplier = Supplier::query()->where('id', $supplierId)->first();

        if($supplier){
            $supplierService = new SupplierService($supplier['method'],$supplierId);
            $goodses = $supplierService->getGoodsList($groupId);
            $goodses = $goodses['data'];
            cache()->put($supplierId.'-'.$groupId,json_encode($goodses));
            $arr = [];
            foreach ($goodses as $k=>$v){
                $arr[] = ['id'=>$v['goods_id'],'text'=>$v['goods_name']];
            }
            return $arr;
        }

        return [];

    }

    public function supplierGoodsData(Request $request){
        $supplierGoodsId = $request->get('supplier_goods_id');
        $supplierId = $request->get('supplier_id');
        $supplierGroupId = $request->get('supplier_group_id');
        $c = cache()->get($supplierId.'-'.$supplierGroupId);
        $goodses = json_decode($c,true);
        foreach ($goodses as $k=>$v){
            if($v['goods_id'] == $supplierGoodsId){
                return $v;
            }
        }

        return [];
    }
}
