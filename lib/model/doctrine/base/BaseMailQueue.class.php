<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseMailQueue extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('mail_queue');
    $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
    $this->hasColumn('created_at', 'timestamp', null, array('type' => 'timestamp'));
    $this->hasColumn('subject', 'string', 255, array('type' => 'string', 'length' => '255'));
    $this->hasColumn('recipients', 'string', null, array('type' => 'string'));
    $this->hasColumn('body', 'string', null, array('type' => 'string'));
    $this->hasColumn('max_attemps', 'integer', 1, array('type' => 'integer', 'default' => '3', 'length' => '1'));
    $this->hasColumn('attemps', 'integer', 1, array('type' => 'integer', 'default' => 0, 'length' => '1'));
  }

}