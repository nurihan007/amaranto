<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseCompany extends Entity
{
  public function setUp()
  {
    parent::setUp();
    $this->hasMany('Person as People', array('local' => 'id',
                                             'foreign' => 'parent_id'));
  }
}