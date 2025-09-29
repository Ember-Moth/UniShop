<?php

namespace App\Admin\Controllers;

use App\Models\Supplier as SupplierModel;
use App\Service\SupplierService;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SupplierController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SupplierModel(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name',"显示名称");
            $grid->column('method','供应商接口');
            $grid->column('enable','启用')->switch();
            $grid->column('sort','排序');
            $grid->column('created_at')->display(function ($v){
                return $v->format('Y-m-d H:i:s');
            });
            $grid->column('updated_at')->display(function ($v){
                return $v->format('Y-m-d H:i:s');
            })->sortable();
//            $grid->disableDeleteButton();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('name');
                $filter->like('method');
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
        return Show::make($id, new SupplierModel(), function (Show $show) {
            $show->field('id');
            $show->field('name',"显示名称");
            $show->field('method','供应商接口');

            $supplier_configs = $this->methods();
            foreach($supplier_configs as $k=>$cs){
                foreach ($cs as $key=>$config){
                    if($show->model()->method == $k){
                        $cc = $show->model()->config;
                        $show->field("config[{$k}][{$key}]", $config['label'])->as(function ($v)use($cc,$key){
                            return $cc[$key];
                        });
                    }
                }
            }

            $show->field('enable','启用')->as(function ($isOpen) {
                if ($isOpen == SupplierModel::STATUS_OPEN) {
                    return admin_trans('dujiaoka.status_open');
                } else {
                    return admin_trans('dujiaoka.status_close');
                }
            });
            $show->field('created_at')->as(function (){
                return $this->created_at->format('Y-m-d H:i:s');
            });
            $show->field('updated_at')->as(function ($v){
                return $this->updated_at->format('Y-m-d H:i:s');
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $request = request();
        return Form::make(new SupplierModel(), function (Form $form)use($request) {
            $form->display('id');
            if($form->isCreating())
                $form->text('uuid',"uuid")->display(false);
            $form->text('config',"config")->customFormat(function ($v){
                return json_encode($v);
            })->display(false);
            $form->text('name',"显示名称")->required();
            $form->text('sort',"排序")->default(0)->required();
            $methods = [];
            $supplier_configs = $this->methods();
            foreach($supplier_configs as $k=>$cs){
                $methods[$k] = $k;
            }
            $form->select('method',"供应商接口")
                ->options($methods)
                ->required();
            foreach($supplier_configs as $k=>$cs){
                foreach ($cs as $key=>$config){
                    $form->text("config[{$k}][{$key}]", $config['label'])
                        ->placeholder($config['description'])
                        ->addElementClass('form-extend-config form-extend-config-'.$k)
                        ->customFormat(function ($v)use($key,$k,$config){
                            if($this->id>0){
                                if($this->method == $k){
                                    return isset($this->config[$key])?$this->config[$key]:'';
                                }
                            }
                            return '';
                        });
                }
            }

            $form->switch('enable')->default(SupplierModel::STATUS_OPEN);
//            $form->display('created_at');
//            $form->display('updated_at');
            admin_js(['@admin/my/js/admin_supplier_form.js']);
            $form->disableDeleteButton();
            $form->submitted(function (Form $form)use($request) {
                $config = $form->config;
                $params = $request->all();
                if(isset($params['config']))
                    $form->config = $config[$form->method];
            });
        });
    }

    public function methods(){
        $methods = [];
        foreach (glob(base_path('app//Suppliers') . '/*.php') as $file) {
//            array_push($methods, pathinfo($file)['filename']);
            $key = pathinfo($file)['filename'];
            $supplierService = new SupplierService($key);
            $methods[$key] = $supplierService->form();
        }
        return $methods;
    }


    public function drop(Request $request)
    {
        $supplier = SupplierModel::find($request->input('id'));
        if (!$supplier) abort(500, '供应商不存在');
        return response([
            'data' => $supplier->delete()
        ]);
    }


    public function sort(Request $request)
    {
        $request->validate([
            'ids' => 'required|array'
        ], [
            'ids.required' => '参数有误',
            'ids.array' => '参数有误'
        ]);
        DB::beginTransaction();
        foreach ($request->input('ids') as $k => $v) {
            if (!SupplierModel::find($v)->update(['sort' => $k + 1])) {
                DB::rollBack();
                abort(500, '保存失败');
            }
        }
        DB::commit();
        return response([
            'data' => true
        ]);
    }
}