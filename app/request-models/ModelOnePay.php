<?php
namespace app\requestModels;
class ModelOnePay extends RequestModelAbstract {
    protected const STATUS_COMPLETE = 'complete';
    protected const STATUS_PENDING = 'pending';
    protected const STATUS_REFUNDED = 'refunded';

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->originalData['userOrderId'] ?? '';
    }

    /**
     * @return string
     */
    public function getExternalTransactionId(): string
    {
        return $this->originalData['transactionId'] ?? '';
    }

    /**
     * @return int
     */
    public function getOrderAmount(): int
    {
        return $this->originalData['amount'] ?? '';
    }

    /**
     * @return int
     */
    public function getOrderCurrency(): int
    {
        return $this->originalData['currency'] ?? '';
    }

    /**
     * @return string
     */
    public function getOrderOriginalData(): string
    {
        return json_encode($this->originalData);
    }

    /**
     * @return bool
     */
    public function isComplete(): bool
    {
        $status = $this->originalData['status'] ?? '';

        return $status === self::STATUS_COMPLETE;
    }

    /**
     * @return bool
     */
    public function isPending(): bool
    {
        $status = $this->originalData['status'] ?? '';

        return $status === self::STATUS_PENDING;
    }

    /**
     * @return bool
     */
    public function isRefund(): bool
    {
        $status = $this->originalData['status'] ?? '';

        return $status === self::STATUS_REFUNDED;
    }

    /**
     * @return bool
     */
    public function isFailed(): bool
    {
        return false;
    }
}