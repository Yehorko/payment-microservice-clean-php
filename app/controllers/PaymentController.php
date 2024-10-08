<?php
namespace app\controllers;

use app\requestModels\RequestModelsFactory;
use Exception;
use app\tasks\ProcessReceiptTask;
use app\tasks\ProcessFailTask;
use app\tasks\ProcessPendingTask;
use app\tasks\ProcessRefundTask;
use function Sodium\randombytes_uniform;

class PaymentController {
    /**
     * @param string $paymentSystemType
     * @param array $paymentData
     * @return void
     * @throws Exception
     */
    public function actionProcessPayment(string $paymentSystemType, array $paymentData){
        // Create unified request model via factory
        $requestModel = (new RequestModelsFactory)->create($paymentSystemType, $paymentData);

        //Select and run task
        if ($requestModel->isComplete()) {
            echo PHP_EOL . "Process complete request..." . PHP_EOL;
            (new ProcessReceiptTask($requestModel))->run();
        }

        if ($requestModel->isFailed()) {
            echo PHP_EOL . "Process failed request..." . PHP_EOL;
            (new ProcessFailTask($requestModel))->run();
        }

        if ($requestModel->isRefund()) {
            echo PHP_EOL . "Process refund request..." . PHP_EOL;
            (new ProcessRefundTask($requestModel))->run();
        }

        if ($requestModel->isPending()) {
            echo PHP_EOL . "Process pending request..." . PHP_EOL;
            (new ProcessPendingTask($requestModel))->run();
        }
    }
}
