<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__)."/BaseDao.class.php";

class superAdminDao extends BaseDao{

  public function __construct(){
    parent::__construct("superAdmin"); // doctor
  }

  public function get_superAdmin_by_AID ($id){  // doctor

      return $this->query_unique("SELECT * FROM superAdmin WHERE Account_ID=:Account_ID", ["Account_ID"=>$id]); // doctor -> superAdmin
    }



}

 ?>
