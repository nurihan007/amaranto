<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseEntity extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('entity');
    $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
    $this->hasColumn('name', 'string', 255, array('type' => 'string', 'notnull' => true, 'length' => '255'));
    $this->hasColumn('code', 'string', 50, array('type' => 'string', 'unique' => true, 'length' => '50'));
    $this->hasColumn('type', 'integer', 2, array('type' => 'integer', 'length' => '2'));
    $this->hasColumn('parent_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
    $this->hasColumn('description', 'string', null, array('type' => 'string'));
    $this->hasColumn('title', 'string', 255, array('type' => 'string', 'length' => '255'));

    $this->setSubClasses(array('Person' => array('type' => '1'), 'Company' => array('type' => '2')));
  }

  public function setUp()
  {
    $this->hasMany('Project as Projects', array('local' => 'id',
                                                'foreign' => 'client_id'));

    $this->hasMany('Note as Notes', array('local' => 'id',
                                          'foreign' => 'entity_id'));

    $this->hasMany('Phonenumber as Phonenumbers', array('local' => 'id',
                                                        'foreign' => 'entity_id'));

    $this->hasMany('Email as Emails', array('local' => 'id',
                                            'foreign' => 'entity_id'));

    $this->hasMany('Location as Locations', array('local' => 'id',
                                                  'foreign' => 'entity_id'));

    $timestampable0 = new Doctrine_Template_Timestampable();
    $this->actAs($timestampable0);
  }
}