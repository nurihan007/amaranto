<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Issue extends BaseIssue
{
  public function isClosed()
  {
    return $this->is_closed;
  }

  public function isResolved()
  {
    return $this->is_resolved;
  }
}

