<?php

namespace App\Service;

use App\Models\Supplier;
use App\Models\User;
use App\Exceptions\RuleValidationException;

class UserSupplierService
{
    /**
     * 获取用户的供应商列表
     *
     * @param int $userId
     * @param bool $enabledOnly
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserSuppliers($userId, $enabledOnly = false)
    {
        $query = Supplier::where('user_id', $userId);
        
        if ($enabledOnly) {
            $query->where('enable', Supplier::STATUS_ENABLED);
        }
        
        return $query->orderBy('sort', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    /**
     * 创建用户供应商配置
     *
     * @param int $userId
     * @param array $data
     * @return Supplier
     * @throws RuleValidationException
     */
    public function createUserSupplier($userId, array $data)
    {
        // 检查用户是否存在
        $user = User::find($userId);
        if (!$user) {
            throw new RuleValidationException('用户不存在');
        }

        // 检查供应商名称是否已存在
        $exists = Supplier::where('user_id', $userId)
            ->where('method', $data['method'])
            ->where('name', $data['name'])
            ->exists();
            
        if ($exists) {
            throw new RuleValidationException('该供应商名称已存在');
        }

        $data['user_id'] = $userId;
        
        return Supplier::create($data);
    }

    /**
     * 更新用户供应商配置
     *
     * @param int $id
     * @param int $userId
     * @param array $data
     * @return Supplier
     * @throws RuleValidationException
     */
    public function updateUserSupplier($id, $userId, array $data)
    {
        $supplier = Supplier::where('id', $id)
            ->where('user_id', $userId)
            ->first();
            
        if (!$supplier) {
            throw new RuleValidationException('供应商配置不存在');
        }

        // 如果要修改method或name，检查是否与其他配置冲突
        if ((isset($data['method']) && $data['method'] !== $supplier->method) ||
            (isset($data['name']) && $data['name'] !== $supplier->name)) {
            
            $checkMethod = $data['method'] ?? $supplier->method;
            $checkName = $data['name'] ?? $supplier->name;
            
            $exists = Supplier::where('user_id', $userId)
                ->where('method', $checkMethod)
                ->where('name', $checkName)
                ->where('id', '!=', $id)
                ->exists();
                
            if ($exists) {
                throw new RuleValidationException('该供应商名称已存在');
            }
        }

        $supplier->update($data);
        
        return $supplier->fresh();
    }

    /**
     * 删除用户供应商配置
     *
     * @param int $id
     * @param int $userId
     * @return bool
     * @throws RuleValidationException
     */
    public function deleteUserSupplier($id, $userId)
    {
        $supplier = Supplier::where('id', $id)
            ->where('user_id', $userId)
            ->first();
            
        if (!$supplier) {
            throw new RuleValidationException('供应商配置不存在');
        }

        return $supplier->delete();
    }

    /**
     * 启用/禁用供应商
     *
     * @param int $id
     * @param int $userId
     * @param int $enable
     * @return Supplier
     * @throws RuleValidationException
     */
    public function toggleSupplierStatus($id, $userId, $enable)
    {
        $supplier = Supplier::where('id', $id)
            ->where('user_id', $userId)
            ->first();
            
        if (!$supplier) {
            throw new RuleValidationException('供应商配置不存在');
        }

        $supplier->update(['enable' => $enable]);
        
        return $supplier->fresh();
    }

    /**
     * 获取供应商详情
     *
     * @param int $id
     * @param int $userId
     * @return Supplier
     * @throws RuleValidationException
     */
    public function getSupplierDetail($id, $userId)
    {
        $supplier = Supplier::where('id', $id)
            ->where('user_id', $userId)
            ->first();
            
        if (!$supplier) {
            throw new RuleValidationException('供应商配置不存在');
        }

        return $supplier;
    }

    /**
     * 获取全局供应商列表（user_id为null）
     *
     * @param bool $enabledOnly
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGlobalSuppliers($enabledOnly = false)
    {
        $query = Supplier::whereNull('user_id');
        
        if ($enabledOnly) {
            $query->where('enable', Supplier::STATUS_ENABLED);
        }
        
        return $query->orderBy('sort', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    /**
     * 根据方法获取供应商
     *
     * @param string $method
     * @param int|null $userId
     * @return Supplier|null
     */
    public function getSupplierByMethod($method, $userId = null)
    {
        return Supplier::where('method', $method)
            ->where('user_id', $userId)
            ->where('enable', Supplier::STATUS_ENABLED)
            ->first();
    }
}