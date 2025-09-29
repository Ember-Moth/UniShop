<?php

return [
    'labels' => [
        'User' => '用户',
        'user' => '用户',
        'User_Manage' => '用户管理',
        'Users' => '用户列表',
    ],

    'fields' => [
        'id' => 'ID',
        'username' => '用户名',
        'email' => '邮箱地址',
        'password' => '密码',
        'amount' => '余额',
        'secret' => '密钥',
        'created_at' => '创建时间',
        'updated_at' => '更新时间',
    ],

    'options' => [
    ],

    'rule_messages' => [
        'create_success' => '用户创建成功！',
        'update_success' => '用户信息更新成功！',
        'delete_success' => '用户删除成功！',
        'username_required' => '用户名不能为空',
        'username_min' => '用户名长度不能少于3个字符',
        'username_max' => '用户名长度不能超过50个字符',
        'username_unique' => '用户名已存在',
        'email_required' => '邮箱地址不能为空',
        'email_email' => '邮箱地址格式不正确',
        'email_unique' => '邮箱地址已存在',
        'password_required' => '密码不能为空',
        'password_min' => '密码长度不能少于6个字符',
        'secret_required' => '密钥不能为空',
        'secret_unique' => '密钥已存在',
    ]
];
