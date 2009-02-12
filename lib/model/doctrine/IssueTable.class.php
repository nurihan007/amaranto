<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class IssueTable extends Doctrine_Table
{
  public function getForShow($parameters)
  {
    return $this->getShowQuery($parameters)->fetchOne();
  }

  public function getListQuery(Doctrine_Query $q)
  {
    $alias = $q->getRootAlias();

    return $q->leftJoin("$alias.OpenedBy ob")
      ->leftJoin("$alias.Status s")
      ->leftJoin("$alias.Priority p")
      ->leftJoin("$alias.Category c")
      ->leftJoin("$alias.OpenedBy o")
      ->addOrderBy("$alias.project_id")
      ->addOrderBy("$alias.status_id")
      ->addOrderBy("$alias.priority_id")
      ->addOrderBy("$alias.id")
    ;
  }

  public function getShowQuery($parameters)
  {
    return $this->createQuery('i')
      ->leftJoin('i.AssignedTo a')
      ->leftJoin('i.Project p')
      ->leftJoin('i.Component c')
      ->leftJoin('i.Milestone m')
      ->leftJoin('i.Status s')
      ->leftJoin('i.Category cat')
      ->leftJoin('i.Priority pri')
      ->addWhere('i.id = ?', $parameters['id'])
    ;
  }

  public function findIds(array $ids)
  {
    return $this->createQuery('i')
      ->whereIn('i.id', $ids)
      ->execute();
  }
}
