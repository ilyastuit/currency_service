<?php

namespace App\Model;

use http\Exception\BadHeaderException;
use InvalidArgumentException;

class User
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function updateTokenAndTime($params)
    {
        $sql = "UPDATE users SET token = :token WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':token', $params['token'], \PDO::PARAM_STR);
        $stmt->bindParam(':username', $params['username'], \PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function findByToken($token)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE token = :token AND token_expire_time >= CURDATE();');
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findByUsernameAndPassword($params)
    {
        $params['password'] = $this->preparePassword($params['password']);
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = :username and password = :password;');
        $stmt->bindParam(':username', $params['username']);
        $stmt->bindParam(':password', $params['password']);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    private function preparePassword($password): string
    {
        return md5($password);
    }

    public function authorize($authorizationHeader)
    {
        if (!$authorizationHeader) {
            throw new BadHeaderException('Bearer authorization failed.');
        }
        $user = $this->findByToken(substr($authorizationHeader, 7));

        if (!$user) {
            throw new InvalidArgumentException('Token not valid.');
        }

        return  $user;
    }
}