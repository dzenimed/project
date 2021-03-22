<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  UserDao extends BaseDao{

  public function getUser_by_email($email){
    return $this->query_unique("SELECT * FROM user WHERE email = :email", ["email"=>$email]);
  }

  public function updateUser_byEmail($email,$user){
    $this->update("user", $id, $user, "email");
  }
}
?>
