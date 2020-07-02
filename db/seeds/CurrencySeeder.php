<?php


use Phinx\Seed\AbstractSeed;
use XMLParser\XMLParser;

class CurrencySeeder extends AbstractSeed
{
    public function run()
    {
        $this->table('currency')->truncate();

        $data = file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp');
        $xml = json_decode(json_encode(XMLParser::decode($data)), true);

        $data = [];
        foreach ($xml['Valute'] as $item) {
            $data[] = [
                'name' => $item['Name'],
                'rate' => $item['Value'],
            ];
        }

        $this->insert('currency', $data);
    }
}
