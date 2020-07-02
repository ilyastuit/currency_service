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



    private function getData()
    {
        $data = file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp');
        return $xml = json_decode(json_encode(XMLParser::decode($data)), true);
    }
}