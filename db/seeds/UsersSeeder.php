<?php


use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    public function run()
    {
        $this->table('users')->truncate();

        $data = [];
        $data[] = [
            'username' => 'express',
            'password' => md5('password'),
            'token' => '123',
            'token_expire_time' => '2020-07-10 14:00:00',
        ];

        $this->insert('users', $data);
    }
}
