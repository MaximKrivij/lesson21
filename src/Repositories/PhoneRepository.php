<?php

namespace App\Repositories;

use App\DataBase\Connection;

class PhoneRepository
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::createConnect();
    }

    public function get(int $id)
    {
        $stmt = $this->pdo->query('SELECT * FROM phones WHERE id = ' . $id);

        return $stmt->fetch();
    }

    public function getPhoneNumberById(int $id): ?string
    {
        $stmt = $this->pdo->prepare('SELECT * FROM phones WHERE id = ?');
        $stmt->execute([$id]);

        $res = $stmt->fetch();

        return $res['phone'] ?: null;
    }

    public function create(string $phone)
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO phones (phone) VALUES(:phone)'
        );

        $stmt->bindParam('phone', $phone);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    public function update($phoneId, $number)
    {
        $stmt = $this->pdo->prepare(' UPDATE phones  SET 
            phone = :phone
            
            WHERE id = :id'
        );

        $stmt->bindValue('phone', $number, \PDO::PARAM_STR);
        $stmt->bindValue('id', $phoneId, \PDO::PARAM_INT);

        $stmt->execute();

    }
}