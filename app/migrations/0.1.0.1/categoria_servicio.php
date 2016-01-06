<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class CategoriaServicioMigration_0101 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'categoria_servicio',
            array(
            'columns' => array(
                new Column(
                    'id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
                        'first' => true
                    )
                ),
                new Column(
                    'nombre',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 200,
                        'after' => 'id'
                    )
                ),
                new Column(
                    'descripcion',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'nombre'
                    )
                ),
                new Column(
                    'categoria_servicio_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'after' => 'descripcion'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('id')),
                new Index('fk_categoria_servicio_categoria_servicio1_idx', array('categoria_servicio_id'))
            ),
            'references' => array(
                new Reference('fk_categoria_servicio_categoria_servicio1', array(
                    'referencedSchema' => 'spapp',
                    'referencedTable' => 'categoria_servicio',
                    'columns' => array('categoria_servicio_id'),
                    'referencedColumns' => array('id')
                ))
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
