<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  UserDao extends BaseDao{

  public function getUser_by_email($email){
    return $this->query_unique("SELECT * FROM mydb.user WHERE email = :email", ["email"=>$email]);
  }

  public function getUser_by_id($id){
    return $this->query_unique("SELECT * FROM mydb.user WHERE user_id = :id",["id"=>$id]);
  }

  public function addUser($user){
    return $this->insert("user", $user);
  }

  public function updateUser($id,$user){
    $this->update("user", $id, $user);
  }

  public function updateUser_byEmail($email,$user){
    $this->update("user", $id, $user, "email");
  }
}
?>
