<?php

namespace app\requestModels;

use \Exception;

class RequestModelsFactory {
    public const PAYMENT_TYPE_ONE = 'OnePay';
    public const PAYMENT_TYPE_TWO = 'TwoPay';
    public const PAYMENT_TYPE_THREE = 'ThreePay';

    private const ERR_PAYMENT_NOT_SUPPORTED = 'Payment type not supported!';

    /**
     * @param string $type
     * @param array $data
     * @return RequestModelAbstract
     * @throws Exception
     */
    public function create(string $type, array $data): RequestModelAbstract
    {
        switch($type) {
            case self::PAYMENT_TYPE_ONE:
                return new ModelOnePay($data);
            case self::PAYMENT_TYPE_TWO:
                return new ModelTwoPay($data);
            case self::PAYMENT_TYPE_THREE:
                return new ModelThreePay($data);
            default:
                throw new Exception(self::ERR_PAYMENT_NOT_SUPPORTED);
        }
    }
}