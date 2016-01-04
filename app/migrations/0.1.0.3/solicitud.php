<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class SolicitudMigration_0103 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'solicitud',
            array(
            'columns' => array(
                new Column(
                    'id_solicitud',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
                        'first' => true
                    )
                ),
                new Column(
                    'fecha',
                    array(
                        'type' => Column::TYPE_DATE,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'id_solicitud'
                    )
                ),
                new Column(
                    'hora',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'fecha'
                    )
                ),
                new Column(
                    'estado',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 4,
                        'after' => 'hora'
                    )
                ),
                new Column(
                    'calificacion',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 4,
                        'after' => 'estado'
                    )
                ),
                new Column(
                    'tipousuario_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'calificacion'
                    )
                ),
                new Column(
                    'servicio_usuario_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'tipousuario_id'
                    )
                ),
                new Column(
                    'observaciones',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'servicio_usuario_id'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('id_solicitud')),
                new Index('fk_solicitud_tipousuario1_idx', array('tipousuario_id')),
                new Index('fk_solicitud_servicio_usuario1_idx', array('servicio_usuario_id'))
            ),
            'references' => array(
                new Reference('fk_solicitud_servicio_usuario1', array(
                    'referencedSchema' => 'spapp',
                    'referencedTable' => 'servicio_usuario',
                    'columns' => array('servicio_usuario_id'),
                    'referencedColumns' => array('id')
                )),
                new Reference('fk_solicitud_tipousuario1', array(
                    'referencedSchema' => 'spapp',
                    'referencedTable' => 'tipo_usuario',
                    'columns' => array('tipousuario_id'),
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
