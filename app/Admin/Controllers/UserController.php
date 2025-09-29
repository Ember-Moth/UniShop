<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\User;
use App\Models\User as UserModel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

class UserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->model()->orderBy('id', 'DESC');
            
            $grid->column('id', admin_trans('user.fields.id'))->sortable();
            $grid->column('username', admin_trans('user.fields.username'))->sortable();
            $grid->column('email', admin_trans('user.fields.email'))->sortable();
            $grid->column('amount', admin_trans('user.fields.amount'))->sortable()->display(function ($amount) {
                return '¥' . number_format($amount, 2);
            });
            $grid->column('secret', admin_trans('user.fields.secret'))->limit(20);
            $grid->column('created_at', admin_trans('user.fields.created_at'))->sortable();
            $grid->column('updated_at', admin_trans('user.fields.updated_at'))->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id', admin_trans('user.fields.id'));
                $filter->like('username', admin_trans('user.fields.username'));
                $filter->like('email', admin_trans('user.fields.email'));
                $filter->between('amount', admin_trans('user.fields.amount'));
                $filter->between('created_at', admin_trans('user.fields.created_at'))->datetime();
            });

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();
            });

            $grid->tools(function (Grid\Tools $tools) {
                $tools->batch(function (Grid\Tools\BatchActions $batch) {
                    $batch->disableDelete();
                });
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
        return Show::make($id, new User(), function (Show $show) {
            $show->field('id', admin_trans('user.fields.id'));
            $show->field('username', admin_trans('user.fields.username'));
            $show->field('email', admin_trans('user.fields.email'));
            $show->field('amount', admin_trans('user.fields.amount'));
            $show->field('secret', admin_trans('user.fields.secret'));
            $show->field('created_at', admin_trans('user.fields.created_at'));
            $show->field('updated_at', admin_trans('user.fields.updated_at'));
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new User(), function (Form $form) {
            $form->display('id');
            
            $form->text('username', admin_trans('user.fields.username'))
                ->required()
                ->rules('required|min:3|max:50|unique:users,username,' . $form->getKey())
                ->help(admin_trans('user.rule_messages.username_min') . '，' . admin_trans('user.rule_messages.username_max') . '，' . admin_trans('user.rule_messages.username_unique'));
            
            $form->email('email', admin_trans('user.fields.email'))
                ->required()
                ->rules('required|email|unique:users,email,' . $form->getKey())
                ->help(admin_trans('user.rule_messages.email_email') . '，' . admin_trans('user.rule_messages.email_unique'));
            
            $form->password('password', admin_trans('user.fields.password'))
                ->rules('required|min:6')
                ->help(admin_trans('user.rule_messages.password_min'));
            
            $form->currency('amount', admin_trans('user.fields.amount'))
                ->symbol('¥')
                ->default(0.00)
                ->help('用户充值余额');
            
            $form->text('secret', admin_trans('user.fields.secret'))
                ->default(function () {
                    return UserModel::generateSecret();
                })
                ->rules('required|unique:users,secret,' . $form->getKey())
                ->help('用户密钥，用于API调用，系统会自动生成');

            $form->display('created_at');
            $form->display('updated_at');

            $form->saving(function (Form $form) {
                // 如果是编辑模式且密码为空，则不更新密码
                if ($form->isEditing() && empty($form->password)) {
                    $form->deleteInput('password');
                }
            });
        });
    }
}
