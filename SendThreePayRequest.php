<?php

require "app/libs/SplAutoload.php";

use app\controllers\PaymentController;
use app\requestModels\RequestModelsFactory;


$paymentData = [
    "order" =>  "12347",
    "txid" =>  "fccc93478b9aec342f620c0c8b82d9ef3a3e8ad73",
    "usdAmount" =>  "50",
    "status" =>  "completed" // статсус может быть "processing", "completed"
];

try {
    (new PaymentController)->actionProcessPayment(RequestModelsFactory::PAYMENT_TYPE_THREE, $paymentData);
} catch (Exception $e) {
    echo $e->getMessage();
}