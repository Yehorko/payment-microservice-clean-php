<?php

require "app/libs/SplAutoload.php";

use app\controllers\PaymentController;
use app\requestModels\RequestModelsFactory;


$paymentData = [
    "transactionId" =>  "9cb3a8a0-1837-1829-9483-704e9013275c",
    "userOrderId" =>  "12345",
    "amount" =>  "50",
    "currency" =>  "USD",
    "status" =>  "complete", //статус может быть complete|pending|refunded
    "orderCreatedAt" =>  "2020-06-02T00 => 09 => 09+00 => 00",
    "orderCompleteAt" =>  "2020-06-02T00 => 09 => 53+00 => 00",
    "refundedAmount" =>  "0",
    "provisionAmount" =>  "0",
    "hash" =>  "5b28c51bb32776e648c94f255ada4cc82212f6b5a785ab37439fcb236a45b03a",
    "email" =>  "patrik@gmail.com",
    "paymentMethod" =>  "creditcard",
    "paymentMethodGroup" =>  "cps",
    "isCash" =>  "0",
    "sendPush" =>  "1",
    "processingTime" =>  "0"
];

try {
    (new PaymentController)->actionProcessPayment(RequestModelsFactory::PAYMENT_TYPE_ONE, $paymentData);
} catch (Exception $e) {
    echo $e->getMessage();
}