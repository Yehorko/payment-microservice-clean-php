<?php
namespace app\models;

class User extends BaseModel {
    protected string $tableName = 'users';

    /**
     * Relation to retrieve user model
     * @return Wallet
     * @throws \Exception
     */
    public function wallet(): Wallet
    {
        $userId = $this->data['id'] ?? null;
        if (!$userId) {
            throw new \Exception('user_id in User record not defined to provide Wallet relation');
        }

        return (new Wallet)->findOne(['user_id' => $userId]);
    }
}