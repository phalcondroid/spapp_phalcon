<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class UsuarioMigration_0106 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'usuario',
            array(
            'columns' => array(
                new Column(
                    'id_usuario',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
                        'first' => true
                    )
                ),
                new Column(
                    'primer_nombre',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 100,
                        'after' => 'id_usuario'
                    )
                ),
                new Column(
                    'segundo_nombre',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 100,
                        'after' => 'primer_nombre'
                    )
                ),
                new Column(
                    'primer_apellido',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 100,
                        'after' => 'segundo_nombre'
                    )
                ),
                new Column(
                    'segundo_apellido',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 100,
                        'after' => 'primer_apellido'
                    )
                ),
                new Column(
                    'correo',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 100,
                        'after' => 'segundo_apellido'
                    )
                ),
                new Column(
                    'descripcion',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'correo'
                    )
                ),
                new Column(
                    'foto',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 1,
                        'after' => 'descripcion'
                    )
                ),
                new Column(
                    'tipousuario_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'foto'
                    )
                ),
                new Column(
                    'tipodocumento_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'tipousuario_id'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('id_usuario')),
                new Index('fk_usuario_tipousuario_idx', array('tipousuario_id')),
                new Index('fk_usuario_tipodocumento1_idx', array('tipodocumento_id'))
            ),
            'references' => array(
                new Reference('fk_usuario_tipodocumento1', array(
                    'referencedSchema' => 'spapp',
                    'referencedTable' => 'tipo_documento',
                    'columns' => array('tipodocumento_id'),
                    'referencedColumns' => array('id')
                )),
                new Reference('fk_usuario_tipousuario', array(
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
