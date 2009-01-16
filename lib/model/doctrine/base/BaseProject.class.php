<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseProject extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('project');
    $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
    $this->hasColumn('name', 'string', 50, array('type' => 'string', 'notnull' => true, 'length' => '50'));
    $this->hasColumn('description', 'string', null, array('type' => 'string'));
    $this->hasColumn('client_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
    $this->hasColumn('owner_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
  }

  public function setUp()
  {
    $this->hasOne('Entity as Client', array('local' => 'client_id',
                                            'foreign' => 'id',
                                            'onDelete' => 'SET NULL'));

    $this->hasOne('sfGuardUser as Owner', array('local' => 'owner_id',
                                                'foreign' => 'id',
                                                'onDelete' => 'SET NULL'));

    $this->hasMany('Note as Notes', array('local' => 'id',
                                          'foreign' => 'project_id'));

    $this->hasMany('Issue as Issues', array('local' => 'id',
                                            'foreign' => 'project_id'));

    $this->hasMany('Component as Components', array('local' => 'id',
                                                    'foreign' => 'project_id'));

    $this->hasMany('Milestone as Milestones', array('local' => 'id',
                                                    'foreign' => 'project_id'));

    $timestampable0 = new Doctrine_Template_Timestampable();
    $this->actAs($timestampable0);
  }
}