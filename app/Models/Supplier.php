<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Supplier extends BaseModel
{
    use SoftDeletes;

    protected $table = 'suppliers';

    /**
     * 状态常量
     */
    const STATUS_ENABLED = 1;  // 启用
    const STATUS_DISABLED = 0; // 禁用

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'method',
        'name',
        'config',
        'enable',
        'sort',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'config' => 'array',
        'enable' => 'integer',
        'sort' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * 状态映射
     *
     * @return array
     */
    public static function getStatusMap()
    {
        return [
            self::STATUS_ENABLED => '启用',
            self::STATUS_DISABLED => '禁用',
        ];
    }

    /**
     * 检查是否启用
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enable === self::STATUS_ENABLED;
    }

    /**
     * 获取供应商配置
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config ?? [];
    }

    /**
     * 设置供应商配置
     *
     * @param array $config
     * @return bool
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
        return $this->save();
    }

    /**
     * 启用供应商
     *
     * @return bool
     */
    public function enableSupplier()
    {
        $this->enable = self::STATUS_ENABLED;
        return $this->save();
    }

    /**
     * 禁用供应商
     *
     * @return bool
     */
    public function disableSupplier()
    {
        $this->enable = self::STATUS_DISABLED;
        return $this->save();
    }

    public static function getAdminSuppliers()
    {
        $suppliers = [
            0=>"自营"
        ];
        $arr=Supplier::where('enable', 1)->pluck('name', 'id');
        foreach ($arr as $k=>$v){
            $suppliers[$k]=$v;
        }
        return $suppliers;
    }
}