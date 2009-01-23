<?php

require_once sfConfig::get('sf_plugins_dir').'/sfDoctrineGuardPlugin/modules/sfGuardUser/lib/BasesfGuardUserActions.class.php';
require_once sfConfig::get('sf_plugins_dir').'/sfDoctrineGuardPlugin/modules/sfGuardUser/lib/sfGuardUserGeneratorConfiguration.class.php';
require_once sfConfig::get('sf_plugins_dir').'/sfDoctrineGuardPlugin/modules/sfGuardUser/lib/sfGuardUserGeneratorHelper.class.php';

/**
 * sfGuardUser actions.
 *
 * @package    sfGuardPlugin
 * @subpackage sfGuardUser
 * @author     Fabien Potencier
 * @version    SVN: $Id: actions.class.php 12896 2008-11-10 19:02:34Z fabien $
 */
class sfGuardUserActions extends BasesfGuardUserActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->forward404unless($request->hasParameter('person_id'));

    $this->form = $this->configuration->getForm();
    $this->form->setDefault('person_id', $request->getParameter('person_id'));
    $this->sf_guard_user = $this->form->getObject();
  }
}
