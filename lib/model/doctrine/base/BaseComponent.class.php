<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseComponent extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('component');
        $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('name', 'string', 64, array('type' => 'string', 'length' => '64'));
        $this->hasColumn('project_id', 'integer', 4, array('type' => 'integer', 'notnull' => true, 'length' => '4'));
        $this->hasColumn('owner_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
    }

    public function setUp()
    {
        $this->hasOne('Project', array('local' => 'project_id',
                                       'foreign' => 'id',
                                       'onDelete' => 'CASCADE'));

        $this->hasOne('sfGuardUser as Owner', array('local' => 'owner_id',
                                                    'foreign' => 'id',
                                                    'onDelete' => 'SET NULL'));

        $this->hasMany('Issue as Issues', array('local' => 'id',
                                                'foreign' => 'component_id'));
    }
}