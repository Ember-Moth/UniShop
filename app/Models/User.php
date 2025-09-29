<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends BaseModel
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'email', 'password', 'amount', 'status','secret_key', 'deleted_at', 'created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
//        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * 生成唯一密钥
     *
     * @return string
     */
    public static function generateSecret()
    {
        do {
            $secret = Str::random(32);
        } while (static::where('secret_key', $secret)->exists());

        return $secret;
    }

    /**
     * 设置密码
     *
     * @param string $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = password_hash($value,PASSWORD_DEFAULT);
    }

    /**
     * 获取余额
     *
     * @return float
     */
    public function getAmountAttribute($value)
    {
        return (float) $value;
    }

    /**
     * 增加余额
     *
     * @param float $amount
     * @return bool
     */
    public function addAmount($amount)
    {
        $this->amount += $amount;
        return $this->save();
    }

    /**
     * 减少余额
     *
     * @param float $amount
     * @return bool
     */
    public function reduceAmount($amount)
    {
        if ($this->amount >= $amount) {
            $this->amount -= $amount;
            return $this->save();
        }
        return false;
    }

    /**
     * 关联订单
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    /**
     * 关联用户供应商
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function suppliers()
    {
        return $this->hasMany(Supplier::class, 'user_id');
    }
}
