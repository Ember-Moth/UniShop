<?php

namespace App\Admin\Controllers;

use App\Models\SystemConfig;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Illuminate\Http\Request;

class SystemConfigController extends AdminController
{
    /**
     * 系统配置列表
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->title('系统配置管理')
            ->description('管理系统配置项')
            ->body($this->grid());
    }

    /**
     * 显示配置详情
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->title('配置详情')
            ->description('查看配置项详细信息')
            ->body(Show::make($id, new SystemConfig()));
    }

    /**
     * 编辑配置
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->title('编辑配置')
            ->description('修改配置项')
            ->body(Form::make(new SystemConfig(), function (Form $form) use ($id) {
                $form->display('id');
                $form->text('key')->readonly();
                $form->text('description')->readonly();
                
                $config = SystemConfig::find($id);
                if ($config) {
                    switch ($config->type) {
                        case 'textarea':
                            $form->textarea('value');
                            break;
                        case 'select':
                            $options = $config->options ?? [];
                            $form->select('value')->options($options);
                            break;
                        case 'switch':
                            $form->switch('value');
                            break;
                        case 'number':
                            $form->number('value');
                            break;
                        default:
                            $form->text('value');
                            break;
                    }
                }
                
                $form->display('created_at');
                $form->display('updated_at');
            }));
    }

    /**
     * 创建配置
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->title('创建配置')
            ->description('添加新的配置项')
            ->body(Form::make(new SystemConfig(), function (Form $form) {
                $form->text('key')->required();
                $form->text('description');
                $form->select('type')
                    ->options([
                        'text' => '文本',
                        'textarea' => '多行文本',
                        'select' => '下拉选择',
                        'switch' => '开关',
                        'number' => '数字'
                    ])
                    ->default('text')
                    ->required();
                $form->textarea('options')->help('JSON格式的选项配置，用于select类型');
                $form->select('group')
                    ->options([
                        'general' => '通用配置',
                        'currency' => '货币配置',
                        'exchange' => '汇率配置',
                        'payment' => '支付配置',
                        'email' => '邮件配置'
                    ])
                    ->default('general')
                    ->required();
                $form->number('sort_order')->default(0);
                $form->switch('is_public')->default(1);
            }));
    }

    /**
     * 构建列表
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SystemConfig(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('key')->sortable();
            $grid->column('value')->limit(50);
            $grid->column('description');
            $grid->column('type')->badge([
                'text' => '文本',
                'textarea' => '多行文本',
                'select' => '下拉选择',
                'switch' => '开关',
                'number' => '数字'
            ]);
            $grid->column('group')->badge([
                'general' => '通用',
                'currency' => '货币',
                'exchange' => '汇率',
                'payment' => '支付',
                'email' => '邮件'
            ]);
            $grid->column('sort_order')->sortable();
            $grid->column('is_public')->switch();
            $grid->column('created_at')->sortable();
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('key');
                $filter->like('description');
                $filter->equal('type')->select([
                    'text' => '文本',
                    'textarea' => '多行文本',
                    'select' => '下拉选择',
                    'switch' => '开关',
                    'number' => '数字'
                ]);
                $filter->equal('group')->select([
                    'general' => '通用配置',
                    'currency' => '货币配置',
                    'exchange' => '汇率配置',
                    'payment' => '支付配置',
                    'email' => '邮件配置'
                ]);
            });

            $grid->actions(function (Grid\Actions $actions) {
                $actions->disableView();
            });
        });
    }

    /**
     * 清除配置缓存
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearCache(Request $request)
    {
        try {
            SystemConfig::clearCache();
            return response()->json(['success' => true, 'message' => '配置缓存清除成功']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => '配置缓存清除失败：' . $e->getMessage()]);
        }
    }

    /**
     * 批量导入配置
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function importConfigs(Request $request)
    {
        try {
            $configs = $request->input('configs', []);
            
            foreach ($configs as $config) {
                SystemConfig::updateOrCreate(
                    ['key' => $config['key']],
                    $config
                );
            }
            
            return response()->json(['success' => true, 'message' => '配置导入成功']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => '配置导入失败：' . $e->getMessage()]);
        }
    }
}
