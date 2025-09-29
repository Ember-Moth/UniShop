<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupplierFieldsToGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->bigInteger('supplier_id')->nullable()->default(0)->after('deleted_at')->comment('货源:0-自营');
            $table->bigInteger('supplier_group_id')->nullable()->default(0)->after('supplier_id')->comment('货源商品分组编号');
            $table->bigInteger('supplier_goods_id')->nullable()->default(0)->after('supplier_group_id')->comment('货源商品编号');
            $table->decimal('supplier_price', 10, 2)->default(0.00)->after('supplier_goods_id')->comment('货源商品价格');
            $table->tinyInteger('supplier_price_type')->default(0)->after('supplier_price')->comment('货源加价模式:1-定额加价；2-比例加价;');
            $table->tinyInteger('supplier_price_type_rule',10,2)->default(0.00)->after('supplier_price_type')->comment(' 定额加价（如：上游价 +30）;比例加价（如：上游价 ×1.3）');

            // 添加索引
            $table->index('supplier_id', 'idx_supplier_id');
            $table->index('supplier_group_id', 'idx_supplier_group_id');
            $table->index('supplier_goods_id', 'idx_supplier_goods_id');
            $table->index('supplier_price_type', 'idx_supplier_price_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods', function (Blueprint $table) {
            // 删除索引
            $table->dropIndex('idx_supplier_id');
            $table->dropIndex('idx_supplier_group_id');
            $table->dropIndex('idx_supplier_goods_id');
            $table->dropIndex('idx_supplier_price_type');
            
            // 删除字段
            $table->dropColumn([
                'supplier_id',
                'supplier_group_id',
                'supplier_goods_id',
                'supplier_price',
                'supplier_price_type'
            ]);
        });
    }
}