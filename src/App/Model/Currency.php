<?php

namespace App\Model;

use XMLParser\XMLParser;

class Currency
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function updateCurrency()
    {
        $xml = $this->getData();
        $error = false;
        foreach ($xml['Valute'] as $item) {
            $name = $item['Name'];
            $value = $item['Value'];
            $sql = "UPDATE currency SET name = '$name', rate = '$value' WHERE name = '$name'";
            $stmt = $this->pdo->prepare($sql);
            if ($stmt->execute() === false) {
                $error = true;
            }
        }
        return $error;
    }

    public function getAll(int $offset, int $limit): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM currency LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        $result['currencies'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM currency WHERE id = ?');
        $stmt->execute([$id]);

        return $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function countAll(): int
    {
        $stmt = $this->pdo->query('SELECT COUNT(id) FROM currency');
        return $stmt->fetchColumn();
    }

    private function getData()
    {
        $data = file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp');
        return $xml = json_decode(json_encode(XMLParser::decode($data)), true);
    }
}