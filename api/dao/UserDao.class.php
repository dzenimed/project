<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  UserDao extends BaseDao{

  public function getUser_by_email($email){
    return $this->query_unique("SELECT * FROM mydb.user WHERE email = :email", ["email"=>$email]);
  }

  public function getUser_by_id($id){
    return $this->query_unique("SELECT * FROM mydb.user WHERE id = :id",["id"=>$id]);
  }
}
?>
