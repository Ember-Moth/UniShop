<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('method', 16)->comment('供应商方法/类型');
            $table->string('name')->comment('供应商名称');
            $table->string('icon')->nullable()->comment('供应商图标');
            $table->text('config')->comment('供应商配置(JSON格式)');
            $table->tinyInteger('enable')->default(0)->comment('是否启用:1-启用,0-禁用');
            $table->integer('sort')->default(0)->comment('排序权重');
            $table->timestamps();
            $table->softDeletes();
            
            // 添加索引
            $table->index('method', 'idx_method');
            $table->index('enable', 'idx_enable');
            $table->index('sort', 'idx_sort');
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
        Schema::dropIfExists('user_suppliers');
    }
}