<?php

namespace app\requestModels;

use \Exception;

abstract class RequestModelAbstract {
    protected const CURRENCY_USD = 'USD';
    protected const SUPPORTED_CURRENCIES = [
        self::CURRENCY_USD,
    ];

    protected const ERR_CURRENCY_NOT_SUPPORTED = 'Currency not supported';
    protected const ERR_AMOUNT_IS_NOT_CORRECT = 'Order amount is not correct';

    protected const ERR_ORIGINAL_DATA_IS_INCORRECT = 'Request data is incorrect';

    protected array $originalData;

    /**
     * @param string $originalRequestData
     * @return void
     * @throws Exception
     */
    public function __construct__(string $originalRequestData) {
        $this->setOrderOriginalData($originalRequestData);
        $this->validate();
    }

    abstract public function getOrderId(): string;

    abstract public function getExternalTransactionId(): string;

    /**
     * @return int
     */
    abstract public function getOrderAmount(): int;

    /**
     * @return int
     */
    abstract public function getOrderCurrency(): int;

    /**
     * @return string
     */
    abstract public function getOrderOriginalData(): string;

    /**
     * @return bool
     */
    abstract public function isComplete(): bool;

    /**
     * @return bool
     */
    abstract public function isPending(): bool;

    /**
     * @return bool
     */
    abstract public function isRefund(): bool;

    /**
     * @return bool
     */
    abstract public function isFailed(): bool;


    /**
     * @param string $originalData
     * @return void
     * @throws Exception
     */
    protected function setOrderOriginalData(string $originalData): void{
        $data = @json_decode($originalData, true);
        if (!$data) {
            throw new Exception(self::ERR_ORIGINAL_DATA_IS_INCORRECT);
        }
        $this->originalData = $data;
    }

    /**
     * @return true
     * @throws Exception
     */
    protected function validate(): bool
    {
        if (!in_array($this->getOrderCurrency(), self::SUPPORTED_CURRENCIES)) {
            throw new Exception(self::ERR_CURRENCY_NOT_SUPPORTED);
        }

        if ($this->getOrderAmount() <= 0) {
            throw new Exception(self::ERR_AMOUNT_IS_NOT_CORRECT);
        }

        return true;
    }
}