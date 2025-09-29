<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RechargeOrder extends Model
{
    use SoftDeletes;

    protected $table = 'recharge_orders';

    // 状态常量
    const STATUS_PENDING = 1;      // 待支付
    const STATUS_PAID = 2;         // 已支付
    const STATUS_COMPLETED = 3;    // 已完成
    const STATUS_FAILED = 4;       // 已失败
    const STATUS_CANCELLED = 5;    // 已取消
    const STATUS_EXPIRED = -1;     // 已过期

    protected $fillable = [
        'order_sn',
        'user_id',
        'amount',
        'actual_amount',
        'bonus_amount',
        'payment_method',
        'pay_id',
        'trade_no',
        'buy_ip',
        'status',
        'remark',
        'payment_data',
        'paid_at',
        'completed_at',
        'expired_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'actual_amount' => 'decimal:2',
        'bonus_amount' => 'decimal:2',
        'payment_data' => 'json',
        'paid_at' => 'datetime',
        'completed_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    protected $dates = [
        'paid_at',
        'completed_at',
        'expired_at',
        'deleted_at',
    ];

    /**
     * 关联用户
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 状态文本映射
     */
    public static function getStatusText($status)
    {
        $statusMap = [
            self::STATUS_PENDING => '待支付',
            self::STATUS_PAID => '已支付',
            self::STATUS_COMPLETED => '已完成',
            self::STATUS_FAILED => '已失败',
            self::STATUS_CANCELLED => '已取消',
            self::STATUS_EXPIRED => '已过期',
        ];

        return $statusMap[$status] ?? '未知状态';
    }

    /**
     * 获取状态文本
     */
    public function getStatusTextAttribute()
    {
        return self::getStatusText($this->status);
    }

    /**
     * 检查是否可以支付
     */
    public function canPay()
    {
        return $this->status === self::STATUS_PENDING && 
               (!$this->expired_at || $this->expired_at > now());
    }

    /**
     * 检查是否已支付
     */
    public function isPaid()
    {
        return in_array($this->status, [self::STATUS_PAID, self::STATUS_COMPLETED]);
    }

    /**
     * 检查是否已完成
     */
    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * 检查是否已过期
     */
    public function isExpired()
    {
        return $this->status === self::STATUS_EXPIRED || 
               ($this->expired_at && $this->expired_at <= now());
    }
}