<?php
namespace app\tasks;

use app\requestModels\RequestModelAbstract;
use app\models\Order;
use app\models\Transaction;
class ProcessPendingTask {
    private RequestModelAbstract $requestModel;
    /**
     * @param RequestModelAbstract $requestModel
     * @return ProcessPendingTask
     */
    public function __construct(RequestModelAbstract $requestModel)
    {
        $this->requestModel = $requestModel;

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function run()
    {
        // Retrieve order
        $order = (new Order())->findOne(['id' => $this->requestModel->getOrderId()]);
        if (!$order) {
            throw new \Exception('Order not found in db!');
        }
        // Save transaction
        $transaction = new Transaction();
        $transaction->setFields([
            'order_id' => $this->requestModel->getOrderId(),
            'currency' => $this->requestModel->getOrderCurrency(),
            'amount' => $this->requestModel->getOrderAmount(),
            'request_data' => $this->requestModel->getOrderOriginalData()
        ]);
        $transaction->save();
        $wallet = $order->user()->wallet();

        echo PHP_EOL . "NEW USER WALLET STATE:" . var_export($wallet->getData(), true) . PHP_EOL;
        // User balance not changed
    }
}