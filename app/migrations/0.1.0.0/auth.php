<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class AuthMigration_0100 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'auth',
            array(
            'columns' => array(
                new Column(
                    'id_auth',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
                        'first' => true
                    )
                ),
                new Column(
                    'key',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'id_auth'
                    )
                ),
                new Column(
                    'platform',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'after' => 'key'
                    )
                ),
                new Column(
                    'uuid',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'platform'
                    )
                ),
                new Column(
                    'session',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 1,
                        'after' => 'uuid'
                    )
                ),
                new Column(
                    'last_connection',
                    array(
                        'type' => Column::TYPE_DATE,
                        'size' => 1,
                        'after' => 'session'
                    )
                ),
                new Column(
                    'first_connection',
                    array(
                        'type' => Column::TYPE_DATETIME,
                        'size' => 1,
                        'after' => 'last_connection'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('id_auth'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '1',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            )
        )
        );
    }
}
