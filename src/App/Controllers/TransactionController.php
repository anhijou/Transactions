<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\TransactionService;
use Framework\TemplateEngine;
use App\Services\ValidatorService;

class TransactionController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private TransactionService $TransactionService
    ) {
    }

    public function createView()
    {
        echo $this->view->render("transactions/create.php");
    }

    public function create()
    {
        $this->validatorService->validateTransaction($_POST);
        $this->TransactionService->create($_POST);
        redirectTo("/");
    }

    public function editeView(array $params)
    {
        $transaction = $this->TransactionService->getUserTransaction($params['transaction']);
        if (!$transaction) {
            redirectTo("/");
        }
        echo $this->view->render("transactions/edit.php", ['transaction' => $transaction]);
    }
    public function edit(array $params)
    {
        $transaction = $this->TransactionService->getUserTransaction($params['transaction']);
        if (!$transaction) {
            redirectTo("/");
        }
        $this->validatorService->validateTransaction($_POST);
        $this->TransactionService->update($_POST, $transaction['id']);
        redirectTo($_SERVER['HTTP_REFERER']);
    }
    public function delete(array $params)
    {

        $this->TransactionService->delete((int) $params['transaction']);
        redirectTo("/");
    }
}
