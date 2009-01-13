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

  public function setCurrEstimate($estimate)
  {
    if (!$this->orig_estimate) {
      $this->orig_estimate = $estimate;
    }
    return $this->_set('curr_estimate', $estimate);
  }

  public function setIsResolved($is_resolved)
  {
    if ($is_resolved) {
      $this->resolved_at = date('Y-m-d H:i:s');
      $this->resolved_by = Listener_Userstampable::getCurrentUserId();
    }
    return $this->_set('is_resolved', $is_resolved);
  }

  public function setIsClosed($is_closed)
  {
    if ($is_closed) {
      $this->closed_at = date('Y-m-d H:i:s');
      $this->closed_by = Listener_Userstampable::getCurrentUserId();
    }
    return $this->_set('is_closed', $is_closed);
  }

  public function setStatusId($status_id)
  {
    if ($status_id != $this->status_id && is_numeric($status_id)) {
      $this->Status = Doctrine::getTable('Status')->find($status_id);
      $this->is_resolved = $this->Status->is_resolved;
      return; // avobe method called _set
    }
    return $this->_set('status_id', $status_id);
  }

  public function preInsert($event)
  {
    $modified = $this->getModified();
    if (!array_key_exists('opened_at', $modified))
    {
      $this->opened_at = date('Y-m-d H:i:s');
    }
    if (!array_key_exists('opened_by', $modified))
    {
      $this->opened_by = Listener_Userstampable::getCurrentUserId();
    }
  }
}

