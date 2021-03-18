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
    $sql = "INSERT INTO user (username, email, password, account_id) VALUES (:username, :email, :password, :account_id)";
    $stmt= $this->connection->prepare($sql);
    $stmt->execute($user);
    $user['id'] = $this->connection->lastInsertId();
    return $user;
  }

  public function updateUser($id,$user){
    $this->update("user", $id, $user);
  }

  public function updateUser_byEmail($email,$user){
    $this->update("user", $id, $user, "email");
  }
}
?>
