<?php

/**
 * Issue form.
 *
 * @package    form
 * @subpackage Issue
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class IssueBatchForm extends IssueForm
{
  public $ids = array();

  public function configure()
  {
    parent::configure();

    $select_widgets = array('status_id', 'category_id', 'project_id',
      'component_id', 'milestone_id', 'assigned_to', 'priority_id');

    foreach ($select_widgets as $widget)
    {
      $this->widgetSchema[$widget]->setOption('add_empty', '-- no change --');
      $this->validatorSchema[$widget]->setOption('required', false);
      $this->setDefault($widget, '');
    }

    unset($this['title']);
  }

  public function updateObject($values = null)
  {
    $issues = new Doctrine_Collection('Issue');
    $values = $this->getChangedValues();

    foreach ($this->ids as $id)
    {
      $issue = Doctrine::getTable('Issue')->getForShow(array('id' => $id));

      $old_data = $issue->toArray(true);
      $issue->fromArray($values);

      $activity = new IssueActivity();
      $activity->fromArray($this->embeddedForms['Activity']->getValues());
      $activity->setIssueAndChanges($issue, $old_data);

      $issues->add($issue);
    }
    $this->object = $issues;

    return $issues;
  }

  public function getChangedValues()
  {
    $changed_values = array();
    foreach ($this->getValues() as $key => $value)
    {
      if ($value != '' && !is_array($value))
      {
        $changed_values[$key] = $value;
      }
    }

    return $changed_values;
  }
}
