<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\BatchRestore;
use App\Admin\Actions\Post\Restore;
use App\Models\Payment;
use App\Models\Payment as PaymentModel;
use App\Service\PaymentService;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new PaymentModel(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name',"显示名称");
            $grid->column('payment','支付接口');
            $grid->column('notify_domain','通知地址')->display(function ($v){
                $notifyUrl = url("pay/notify/{$this->payment}/{$this->uuid}");
                if ($this->notify_domain) {
                    $parseUrl = parse_url($notifyUrl);
                    $notifyUrl = $this->notify_domain . $parseUrl['path'];
                }
                return $notifyUrl;
            });
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
                $filter->like('payment');
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
        return Show::make($id, new PaymentModel(), function (Show $show) {
            $show->field('id');
            $show->field('uuid');
            $show->field('name',"显示名称");
            $show->field('payment','支付接口');

            $show->field('notify_domain','通知地址')->as(function ($v)use($show){
                $notifyUrl = url("pay/notify/{$show->model()->payment}/{$show->model()->uuid}");
                if ($show->model()->notify_domain) {
                    $parseUrl = parse_url($notifyUrl);
                    $notifyUrl = $show->model()->notify_domain . $parseUrl['path'];
                }
                return $notifyUrl;
            });
            $payment_configs = $this->payment_configs();
            foreach($payment_configs as $k=>$cs){
                foreach ($cs as $key=>$config){
                    if($show->model()->payment == $k){
                        $cc = $show->model()->config;
                        $show->field("config[{$k}][{$key}]", $config['label'])->as(function ($v)use($cc,$key){
                            return $cc[$key];
                        });
                    }
                }
            }

            $show->field('enable','启用')->as(function ($isOpen) {
                if ($isOpen == PaymentModel::STATUS_OPEN) {
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
        return Form::make(new PaymentModel(), function (Form $form)use($request) {
            $form->display('id');
            if($form->isCreating())
                $form->text('uuid',"uuid")->display(false);
            $form->text('config',"config")->customFormat(function ($v){
                return json_encode($v);
            })->display(false);
            $form->text('name',"显示名称")->required();
            $form->text('notify_domain',"自定义通知域名(选填)")->placeholder("网关的通知将会发送到该域名(https://x.com)");
            $form->text('sort',"排序")->default(0)->required();
            $methods = [];
            $payment_configs = $this->payment_configs();
            foreach($payment_configs as $k=>$cs){
                $methods[$k] = $k;
            }
            $form->select('payment',"支付接口")
                ->options($methods)
                ->required();

            foreach($payment_configs as $k=>$cs){
                foreach ($cs as $key=>$config){
                    $form->text("config[{$k}][{$key}]", $config['label'])
                        ->placeholder($config['description'])
                        ->addElementClass('form-extend-config form-extend-config-'.$k)
                        ->customFormat(function ($v)use($key,$k,$config){
                            if($this->id>0){
                                if($this->payment == $k){
                                    return isset($this->config[$key])?$this->config[$key]:'';
                                }
                            }
                            return '';
                        });
                }
            }

            $form->switch('enable')->default(PaymentModel::STATUS_OPEN);
//            $form->display('created_at');
//            $form->display('updated_at');
            admin_js(['@admin/my/js/admin_payment_form.js']);
            $form->disableDeleteButton();
            $form->submitted(function (Form $form)use($request) {
               $config = $form->config;
               if($form->isCreating())
                    $form->uuid = Str::random(8);
               $params = $request->all();
                if(isset($params['config']))
                    $form->config = $config[$form->payment];
            });
        });
    }

    public function payment_configs(){
        $methods = [];
        foreach (glob(base_path('app//Payments') . '/*.php') as $file) {
//            array_push($methods, pathinfo($file)['filename']);
            $key = pathinfo($file)['filename'];
            $paymentService = new PaymentService($key);
            $methods[$key] = $paymentService->form();
        }
        return $methods;
    }


    public function drop(Request $request)
    {
        $payment = Payment::find($request->input('id'));
        if (!$payment) abort(500, '支付方式不存在');
        return response([
            'data' => $payment->delete()
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
            if (!Payment::find($v)->update(['sort' => $k + 1])) {
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
