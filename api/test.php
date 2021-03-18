<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/UserDao.class.php";

$user_dao = new UserDao();

//$user = $user_dao -> getUser_by_email("emma.lowrey@gmail.com");


// $user = $user_dao->getUser_by_id(2);

/* $user1 = [
  "username" => "Joe Blue",
  "email"=>"joe.blue@live.com",
  "password"=>"key1112",
  "account_id"=>3
]; */
//$user = $user_dao->addUser($user1);

/* $user1 = [
  "username" => "Joe Blue",
  "email"=>"joe.blue@live.com",
  "password"=>"key12"
];  */

$user1 = [
  "password"=>"key112"
];

$user = $user_dao->updateUser_byEmail("joe.blue@live.com", $user1);

print_r($user1);
?>
