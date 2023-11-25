<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{

    public function __construct(private Database $db)
    {
    }
    public function create(array $formData)
    {
        $formattedDate = "{$formData['date']} 00:00:00";
        $this->db->query("INSERT INTO transactions (description,amount,date,user_id) VALUES(:description,:amount,:date,:user_id)", [
            'description' => $formData['description'],
            'amount' => $formData['amount'],
            'date' => $formattedDate,
            'user_id' => $_SESSION['user']
        ]);
    }
}
