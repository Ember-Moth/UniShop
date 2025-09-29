<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class EmailOtpLog extends BaseModel
{

    use SoftDeletes;

    protected $table = 'email_otp_log';
    /**
     * 跳转
     */
    const TYPE_REGISTER = "register";//注册
    const TYPE_FORGET = "forget";//忘记密码

}
