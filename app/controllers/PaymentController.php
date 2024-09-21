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
            (new ProcessReceiptTask($requestModel))->run();
        }

        if ($requestModel->isFailed()) {
            (new ProcessFailTask($requestModel))->run();
        }

        if ($requestModel->isRefund()) {
            (new ProcessRefundTask($requestModel))->run();
        }

        if ($requestModel->isPending()) {
            (new ProcessPendingTask($requestModel))->run();
        }
    }
}
