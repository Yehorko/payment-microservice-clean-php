<?php
namespace app\requestModels;
class ModelThreePay extends RequestModelAbstract {
    protected const STATUS_COMPLETE = 'completed';
    protected const STATUS_PROCESSING = 'processing';

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->originalData['order'] ?? '';
    }

    /**
     * @return string
     */
    public function getExternalTransactionId(): string
    {
        return $this->originalData['txid'] ?? '';
    }

    /**
     * @return int
     */
    public function getOrderAmount(): int
    {
        return $this->originalData['usdAmount'] ?? '';
    }

    /**
     * @return int
     */
    public function getOrderCurrency(): int
    {
        return self::CURRENCY_USD;
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

        return $status === self::STATUS_PROCESSING;
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
        return false;
    }
}