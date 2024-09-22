<?php
namespace app\requestModels;
class ModelTwoPay extends RequestModelAbstract {
    protected const STATUS_COMPLETE = 2;
    protected const STATUS_PENDING = 4;
    protected const STATUS_FAILED = 3;

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->originalData['orderId'] ?? '';
    }

    /**
     * @return string
     */
    public function getExternalTransactionId(): string
    {
        return $this->originalData['identifier'] ?? '';
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
    public function getOrderCurrency(): string
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
        $status = $this->originalData['state'] ?? '';

        return $status === self::STATUS_COMPLETE;
    }

    /**
     * @return bool
     */
    public function isPending(): bool
    {
        $status = $this->originalData['state'] ?? '';

        return $status === self::STATUS_PENDING;
    }

    /**
     * @return bool
     */
    public function isRefund(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isFailed(): bool
    {
        $status = $this->originalData['state'] ?? '';

        return $status === self::STATUS_FAILED;
    }
}