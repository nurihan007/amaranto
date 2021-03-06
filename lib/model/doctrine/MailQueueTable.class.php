<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class MailQueueTable extends Doctrine_Table
{
  public function getPending($limit = 50)
  {
    return $this->createQuery('q')
      ->addWhere('q.attemps < q.max_attemps')
      ->limit($limit)
      ->execute();
  }

  public function deleteItems(array $done)
  {
    if (sizeof($done) == 0) return 0;

    return $this->createQuery('q')
      ->delete()
      ->whereIn('q.id', $done)
      ->execute();
  }

  public function recordAttemps(array $failed)
  {
    if (sizeof($failed) == 0) return 0;

    return $this->createQuery('q')
      ->update()
      ->set('attemps', 'attemps + 1')
      ->whereIn('q.id', $failed)
      ->execute();
  }

  public function deleteStale()
  {
    return $this->createQuery('q')
      ->delete()
      ->addWhere('max_attemps = attemps')
      ->execute();
  }
}
