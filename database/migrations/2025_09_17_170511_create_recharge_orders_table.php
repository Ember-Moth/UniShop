<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRechargeOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recharge_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_sn', 150)->unique()->comment('充值订单号');
            $table->bigInteger('user_id')->comment('用户ID');
            $table->decimal('amount', 10, 2)->comment('充值金额');
            $table->decimal('actual_amount', 10, 2)->default(0.00)->comment('实际到账金额');
            $table->decimal('bonus_amount', 10, 2)->default(0.00)->comment('赠送金额');
            $table->string('payment_method', 50)->comment('支付方式');
            $table->integer('pay_id')->nullable()->comment('支付通道ID');
            $table->string('trade_no', 200)->default('')->comment('第三方支付订单号');
            $table->string('buy_ip', 50)->comment('充值IP地址');
            $table->tinyInteger('status')->default(1)->comment('状态:1-待支付,2-已支付,3-已完成,4-已失败,5-已取消,-1-已过期');
            $table->text('remark')->nullable()->comment('备注');
            $table->json('payment_data')->nullable()->comment('支付相关数据');
            $table->timestamp('paid_at')->nullable()->comment('支付时间');
            $table->timestamp('completed_at')->nullable()->comment('完成时间');
            $table->timestamp('expired_at')->nullable()->comment('过期时间');
            $table->timestamps();
            $table->softDeletes();
            
            // 添加索引
            $table->index('user_id', 'idx_user_id');
            $table->index('order_sn', 'idx_order_sn');
            $table->index('status', 'idx_status');
            $table->index('payment_method', 'idx_payment_method');
            $table->index('trade_no', 'idx_trade_no');
            $table->index('created_at', 'idx_created_at');
            $table->index('paid_at', 'idx_paid_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recharge_orders');
    }
}