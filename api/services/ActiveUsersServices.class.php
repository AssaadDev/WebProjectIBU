<?php
require_once dirname(__FILE__)."/../dao/AccountDao.class.php";
require_once dirname(__FILE__)."/../dao/UserDao.class.php";
require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../Utils.class.php';

require_once dirname(__FILE__).'/../clients/SMTPClient.class.php';
require_once dirname(__FILE__).'/../dao/ActiveUserDao.class.php';
require_once dirname(__FILE__).'/../dao/SuperAdminDao.class.php';
require_once dirname(__FILE__).'/../clients/SMTPClient.class.php';
require_once dirname(__FILE__).'/../dao/BaseDao.class.php';




class PatientService extends BaseService{

  public function __construct(){
    $this->dao=new PatientDao();
  }

    public function get_accounts($search, $offset, $limit, $order){
        if ($search){
          return $this->dao->get_accounts($search, $offset, $limit, $order);
        }else{
          return $this->dao->get_all($offset, $limit, $order);
        }
      }

      public function update_email_template($user, $id, $email_template){
  $db_template = $this->dao->get_by_id($id);

  return $this->update($id, $email_template);
}


public function get_email_templates($account_id, $offset, $limit, $search, $order, $total = FALSE){
   return $this->dao->get_email_templates($account_id, $offset, $limit, $search, $order, $total);
 }

 public function get_by_accounts_id($account_id){
    return $this->dao->get_user_by_accounts_id($account_id);
  }






}













 ?>
