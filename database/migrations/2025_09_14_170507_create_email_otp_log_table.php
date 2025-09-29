<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailOtpLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_otp_log', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement()->primary();
            $table->bigInteger('user_id')->comment('用户ID');
            $table->string('email')->comment('邮箱地址');
            $table->string('code', 10)->comment('验证码');
            $table->string('error_msg')->comment('异常信息');
            $table->tinyInteger('status')->default(0)->comment('状态:1:发送成功,0:发送失败');
            $table->string('type', 64)->comment('类型:register-注册,forget-忘记密码');
            $table->integer('resend_time')->default(60)->comment('重发间隔时间(秒)');
            $table->integer('expire_time')->default(600)->comment('过期时间(秒)');
            $table->tinyInteger('is_used')->default(0)->comment('是否已使用:1-已使用,0-未使用');
            $table->timestamps();
            $table->softDeletes();
            
            // 添加索引
            $table->index(['email', 'type'], 'idx_email_type');
            $table->index('created_at', 'idx_created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_otp_log');
    }
}
