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
    public function getUserTransactions()
    {
        $searchTerm = $_GET['s'] ?? '';

        $transactions = $this->db->query("SELECT *,DATE_FORMAT(date,'%Y-%m-%d') as formatted_date FROM transactions WHERE user_id = :user_id AND description LIKE :description ", [

            'user_id' => $_SESSION['user'],
            'description' => "%{$searchTerm}%"
        ])->findAll();

        return $transactions;
    }
}
