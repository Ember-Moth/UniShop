<?php

namespace App\Models;


use App\Events\GoodsDeleted;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends BaseModel
{

    use SoftDeletes;

    protected $table = 'goods';

    // 货源加价模式常量
    const SUPPLIER_PRICE_TYPE_FIXED = 1;      // 定额加价
    const SUPPLIER_PRICE_TYPE_PERCENTAGE = 2; // 比例加价

    protected $fillable = [
        'gd_name',
        'gd_description', 
        'gd_keywords',
        'picture',
        'group_id',
        'type',
        'retail_price',
        'actual_price',
        'in_stock',
        'sales_volume',
        'buy_limit_num',
        'buy_prompt',
        'description',
        'ord',
        'is_open',
        'wholesale_price_cnf',
        'other_ipu_cnf',
        'api_hook',
        'supplier_id',
        'supplier_group_id',
        'supplier_goods_id',
        'supplier_price',
        'supplier_price_type',
        'supplier_price_type_rule',
    ];

    protected $casts = [
        'retail_price' => 'decimal:2',
        'actual_price' => 'decimal:2',
        'supplier_price' => 'decimal:2',
    ];

    protected $dispatchesEvents = [
        'deleted' => GoodsDeleted::class
    ];

    /**
     * 关联分类
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author    assimon<ashang@utf8.hk>
     * @copyright assimon<ashang@utf8.hk>
     * @link      http://utf8.hk/
     */
    public function group()
    {
        return $this->belongsTo(GoodsGroup::class, 'group_id');
    }

    /**
     * 关联优惠券
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * @author    assimon<ashang@utf8.hk>
     * @copyright assimon<ashang@utf8.hk>
     * @link      http://utf8.hk/
     */
    public function coupon()
    {
        return $this->belongsToMany(Coupon::class, 'coupons_goods', 'goods_id', 'coupons_id');
    }

    /**
     * 关联卡密
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author    assimon<ashang@utf8.hk>
     * @copyright assimon<ashang@utf8.hk>
     * @link      http://utf8.hk/
     */
    public function carmis()
    {
        return $this->hasMany(Carmis::class, 'goods_id');
    }

    /**
     * 库存读取器,将自动发货的库存更改为未出售卡密的数量
     *
     * @author    assimon<ashang@utf8.hk>
     * @copyright assimon<ashang@utf8.hk>
     * @link      http://utf8.hk/
     */
    public function getInStockAttribute()
    {
        if (isset($this->attributes['carmis_count'])
            &&
            $this->attributes['type'] == self::AUTOMATIC_DELIVERY
        ) {
           $this->attributes['in_stock'] = $this->attributes['carmis_count'];
        }
        return $this->attributes['in_stock'];
    }

    /**
     * 获取货源加价模式映射
     *
     * @return array
     */
    public static function getSupplierPriceTypeMap()
    {
        return [
            self::SUPPLIER_PRICE_TYPE_FIXED => '定额加价',
            self::SUPPLIER_PRICE_TYPE_PERCENTAGE => '比例加价',
        ];
    }

    /**
     * 获取货源加价模式文本
     *
     * @return string
     */
    public function getSupplierPriceTypeTextAttribute()
    {
        $map = self::getSupplierPriceTypeMap();
        return $map[$this->supplier_price_type] ?? '未知';
    }

    /**
     * 判断是否为自营商品
     *
     * @return bool
     */
    public function isSelfOperated()
    {
        return $this->supplier_id == 0;
    }

    /**
     * 判断是否为供应商商品
     *
     * @return bool
     */
    public function isSupplierGoods()
    {
        return $this->supplier_id > 0;
    }

    /**
     * 关联供应商（如果有的话）
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    /**
     * 计算最终售价（考虑供应商加价）
     *
     * @return float
     */
    public function calculateFinalPrice()
    {
        if ($this->isSelfOperated() || !$this->supplier_price) {
            return $this->actual_price;
        }

        $supplierPrice = $this->supplier_price;
        
        switch ($this->supplier_price_type) {
            case self::SUPPLIER_PRICE_TYPE_FIXED:
                // 定额加价：供应商价格 + 加价金额
                return $supplierPrice + $this->actual_price;
                
            case self::SUPPLIER_PRICE_TYPE_PERCENTAGE:
                // 比例加价：供应商价格 * (1 + 加价比例)
                $markupRate = $this->actual_price / 100; // actual_price 存储加价百分比
                return $supplierPrice * (1 + $markupRate);
                
            default:
                return $this->actual_price;
        }
    }

    /**
     * 获取组建映射
     *
     * @return array
     *
     * @author    assimon<ashang@utf8.hk>
     * @copyright assimon<ashang@utf8.hk>
     * @link      http://utf8.hk/
     */
    public static function getGoodsTypeMap()
    {
        return [
            self::AUTOMATIC_DELIVERY => admin_trans('goods.fields.automatic_delivery'),
            self::MANUAL_PROCESSING => admin_trans('goods.fields.manual_processing')
        ];
    }

}
