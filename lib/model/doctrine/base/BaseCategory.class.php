<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseCategory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('category');
        $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('name', 'string', 64, array('type' => 'string', 'length' => '64'));
    }

    public function setUp()
    {
        $this->hasMany('Issue as Issues', array('local' => 'id',
                                                'foreign' => 'category_id'));
    }
}