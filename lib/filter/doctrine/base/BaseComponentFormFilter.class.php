<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Component filter form base class.
 *
 * @package    filters
 * @subpackage Component *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseComponentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'       => new sfWidgetFormFilterInput(),
      'project_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Project', 'add_empty' => true)),
      'owner_id'   => new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'       => new sfValidatorPass(array('required' => false)),
      'project_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Project', 'column' => 'id')),
      'owner_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('component_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Component';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'name'       => 'Text',
      'project_id' => 'ForeignKey',
      'owner_id'   => 'ForeignKey',
    );
  }
}