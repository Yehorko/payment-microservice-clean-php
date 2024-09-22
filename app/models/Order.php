<?php
namespace app\models;

class Order extends BaseModel
{
    protected string $tableName = 'orders';

    /**
     * Relation to retrieve user model
     * @return User
     * @throws \Exception
     */
    public function user(): User
    {
        $userId = $this->data['user_id'] ?? null;

        if (!$userId) {
            throw new \Exception(PHP_EOL . 'user_id in Order record not defined to provide User relation' . PHP_EOL);
        }

        return (new User)->findOne(['id' => $userId]);
    }
}