<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgentFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->tinyInteger('is_agent')->default(0)->comment('代理商订单1-是,0-否')->after('deleted_at');
            $table->string('agent_order_sn', 150)->comment('代理订单号')->after('is_agent');
            $table->text('agent_data')->nullable()->comment('代理数据')->after('agent_order_sn');
            
            // 添加索引
            $table->index('is_agent', 'idx_is_agent');
            $table->index('agent_order_sn', 'idx_agent_order_sn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('idx_agent_order_sn');
            $table->dropIndex('idx_is_agent');
            $table->dropColumn(['is_agent', 'agent_order_sn', 'agent_data']);
        });
    }
}