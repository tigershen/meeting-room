<?php


use Phinx\Migration\AbstractMigration;

class MyNewMigration extends AbstractMigration
{
    public function change()
    {
        $users = $this->table('events',[
            'engine' => 'MyISAM', 
            'signed' => false
        ]);

        $users
        ->addColumn('title', 'string', ['limit'=>100])
        ->addColumn('register', 'string', ['limit'=>20])
        ->addColumn('start', 'datetime')
        ->addColumn('end', 'datetime')
        ->addColumn('roomID', 'integer', ['signed'=>false, 'default'=>0])
        ->addColumn('created_at', 'datetime', ['default'=>'CURRENT_TIMESTAMP'])
        ->addIndex(['start', 'end'])
        ->create();

    }
}
