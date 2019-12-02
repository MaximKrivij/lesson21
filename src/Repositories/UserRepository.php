<?php
namespace App\Repositories;

use App\DataBase\Connection;

class UserRepository
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
        $stmt = $this->pdo->query('SELECT * FROM users WHERE id = ' . $id);

        return $stmt->fetch();
    }

    public function getListWithPhone()
    {
        $stmt = $this->pdo->query('SELECT users.id, users.first_name, users.last_name,
       users.email, phones.phone as phone
       FROM users
        LEFT JOIN phones on users.phone_id = phones.id');

        return $stmt->fetchAll();
    }

    public function getList()
    {
        $stmt = $this->pdo->query('SELECT * FROM users');

        return $stmt->fetchAll();
    }

    public function update(int $id, array $user)
    {
        $stmt = $this->pdo->prepare(' UPDATE users  SET 
            first_name = :first_name, 
            last_name = :last_name, 
            email = :email
               
             WHERE id = :id'
        );

        $firstName = $user['first_name'];
        $lastName = $user['last_name'];
        $stmt->bindParam('first_name', $firstName, \PDO::PARAM_STR );
        $stmt->bindValue('last_name', $lastName, \PDO::PARAM_STR );
        $stmt->bindValue('email', $user['email'], \PDO::PARAM_STR );
        $stmt->bindValue('id', $id, \PDO::PARAM_INT );

        $stmt->execute();
    }

    public function create(array $user,  $phoneId)
    {
        $stmt = $this->getStmtInsert();
        $stmt->execute([
            $user['first_name'],
            $user['last_name'],
            $user['email'],
          $phoneId,
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = :id');
        $stmt->bindValue('id', $id );

        $stmt->execute();
    }

    private function getStmtInsert(): \PDOStatement
    {
        return $this->pdo->prepare(
            'INSERT INTO users (first_name, last_name, email, phone_id) VALUES(?, ?, ?, ?)'
        );
    }
}