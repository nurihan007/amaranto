<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CompanyTable extends EntityTable
{
  public function getOrCreate($company_name)
  {
    $company = $this->findOneBy('name', $company_name);
    if ( $company !== false )
    {
      return $company;
    }
    else
    {
      return $this->create(array('name' => $company_name));
    }
  }
}
