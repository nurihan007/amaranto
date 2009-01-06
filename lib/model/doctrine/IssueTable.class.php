<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class IssueTable extends Doctrine_Table
{
  public function getListQuery()
  {
    return $this->createQuery('i')
      ->leftJoin('i.OpenedBy ob')
      ->leftJoin('i.Status s')
      ->leftJoin('i.Priority p')
      ->leftJoin('i.Category c')
      ->addOrderBy('i.priority_id')
      ->addOrderBy('i.deadline')
    ;
  }
}
