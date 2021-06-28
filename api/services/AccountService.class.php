<?php
require_once dirname(__FILE__)."/../dao/AccountDao.class.php";
require_once dirname(__FILE__)."/../dao/UserDao.class.php";
require_once dirname(__FILE__).'/BaseService.class.php';


class AccountService extends BaseService{



  public function __construct(){
    $this-> dao=new AccountDao();
    $this-> dao2=new UserDao();
  }



  public function get_accounts($search, $offset, $limit, $order){
      if ($search){
        return $this->dao->get_accounts($search, $offset, $limit, $order);
      }else{
        return $this->dao->get_all($offset, $limit, $order);
      }
    }


  public function add ($account){

    if (!isset($account["Nickname"])) throw new Exception ("Nickname wasnt defined");
    return parent::add($account);
  }






} ?>
