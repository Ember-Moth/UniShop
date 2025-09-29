<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement()->primary();
            $table->string('email')->unique()->comment('用户邮箱');
            $table->string('password',80)->comment('用户密码');
            $table->decimal('amount', 16, 2)->default(0.00)->comment('用户余额');
            $table->tinyInteger('status')->default(1)->comment('用户状态:1-正常,2-禁用');
            $table->string('secret_key', 128)->comment('用户密钥');
            $table->timestamps();
            $table->softDeletes();
            
            // 添加索引
            $table->index('email', 'idx_email');
            $table->index('secret_key', 'idx_secret_key');
            $table->index('status', 'idx_status');
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
        Schema::dropIfExists('users');
    }
}