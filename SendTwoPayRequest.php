<?php

require "app/libs/SplAutoload.php";

use app\controllers\PaymentController;
use app\requestModels\RequestModelsFactory;


$paymentData = [
    "identifier" =>  "68a65964-4db8-4a7f-ad26-a97f699d155e",
    "orderId" =>  "12346",
    "amount" =>  "50",
    "currency" =>  "USD",
    "state" =>  2, //состояние может быть 2 - complete, 3 - failed, 4 - pending
    "createdAt" =>  1589936109,
    "updatedAt" =>  1589936121,
    "refundedAmount" =>  "0",
    "provisionAmount" =>  "0",
    "hash" =>  "5b28c51bb32776e648c94f255ada4cc82212f6b5a785ab37439fcb236a45b03a",
    "email" =>  "patrik@gmail.com",
    "cardMetadata" =>  [
        "bin" =>  "551029",
        "lastDigits" =>  "3659",
        "paymentSystem" =>  "mastercard",
        "country" =>  "CA",
        "holderName" =>  "Patrik Russel"
    ]
];

try {
    (new PaymentController)->actionProcessPayment(RequestModelsFactory::PAYMENT_TYPE_TWO, $paymentData);
} catch (Exception $e) {
    echo $e->getMessage();
}