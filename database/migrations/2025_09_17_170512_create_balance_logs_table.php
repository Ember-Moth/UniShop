<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('log_sn', 150)->unique()->comment('变动流水号');
            $table->bigInteger('user_id')->comment('用户ID');
            $table->tinyInteger('type')->comment('变动类型:1-充值,2-消费,3-退款,4-奖励,5-扣除,6-转账转入,7-转账转出');
            $table->decimal('amount', 10, 2)->comment('变动金额(正数为增加，负数为减少)');
            $table->decimal('balance_before', 10, 2)->comment('变动前余额');
            $table->decimal('balance_after', 10, 2)->comment('变动后余额');
            $table->string('source_type', 100)->nullable()->comment('来源类型:recharge_order,order,refund,reward,manual');
            $table->bigInteger('source_id')->nullable()->comment('来源ID');
            $table->string('title', 200)->comment('变动标题');
            $table->text('description')->nullable()->comment('变动描述');
            $table->string('admin_user', 100)->nullable()->comment('操作管理员(手动操作时)');
            $table->json('extra_data')->nullable()->comment('扩展数据');
            $table->timestamps();
            
            // 添加索引
            $table->index('user_id', 'idx_user_id');
            $table->index('log_sn', 'idx_log_sn');
            $table->index('type', 'idx_type');
            $table->index('source_type', 'idx_source_type');
            $table->index('source_id', 'idx_source_id');
            $table->index(['source_type', 'source_id'], 'idx_source_type_id');
            $table->index('created_at', 'idx_created_at');
            $table->index(['user_id', 'type'], 'idx_user_type');
            $table->index(['user_id', 'created_at'], 'idx_user_created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balance_logs');
    }
}