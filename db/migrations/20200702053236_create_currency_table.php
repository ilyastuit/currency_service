<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCurrencyTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('currency')
            ->addColumn('name', 'string')
            ->addColumn('rate', 'string')
            ->create();
    }
}
