<?php

/**
 * milestones actions.
 *
 * @package    amaranto
 * @subpackage milestones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class milestonesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->milestone_list = $this->getRoute()->getObjects();
  }

  public function executeNew(sfWebRequest $request)
  {
    $project = Doctrine::getTable('Project')->find($request->getParameter('project_id'));
    $this->forward404unless($project);

    $milestone = new Milestone();
    $milestone->Project = $project;
    $this->form = new MilestoneForm($milestone);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new MilestoneForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->form = new MilestoneForm($this->getRoute()->getObject());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new MilestoneForm($this->getRoute()->getObject());

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $object = $this->getRoute()->getObject();
    $project_id = $object->project_id;
    $object->delete();

    $this->redirect('@projects_show?id='.$project_id);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $milestone = $form->save();

      $this->redirect('@projects_show?id='.$milestone['project_id']);
    }
  }

  public function executeAjaxList(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');

    $companies = Doctrine::getTable('Milestone')->findForAjax(
      $request->getParameter('id')
    );

    return $this->renderText( json_encode($companies) );
  }
}
