<?php


require_once dirname(__FILE__)."/BaseDao.class.php";
class UserDao extends BaseDao{
public function __construct(){
    parent::__construct("users");
}


public function get_user_by_token ($token){

  return $this->query_unique("SELECT * FROM users WHERE token=:token", ["token"=>$token]);
}

public function get_user_by_email($email){
   return $this->query_unique("SELECT * FROM users WHERE Email = :Email", ["Email" => $email]);
 }
 public function get_user_by_account_id($id){
    return $this->query_unique("SELECT * FROM users WHERE account_id = :account_id", ["account_id" =>$id]);
  }

  public function get_accounts($search, $offset, $limit, $order){
      list($order_column, $order_direction) = self::parse_order($order);

      return $this->query("SELECT *
                           FROM users
                           WHERE LOWER(name) LIKE CONCAT('%', :name, '%')
                           ORDER BY ${order_column} ${order_direction}
                           LIMIT ${limit} OFFSET ${offset}",
                           ["name" => strtolower($search)]);
    }



}

 ?>
