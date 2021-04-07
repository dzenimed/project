<?php
require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../api/dao/UserDao.class.php';
require_once dirname(__FILE__).'/../api/dao/AccountDao.class.php';

class UserService extends BaseService{
  private $accountDao;

  public function __construct(){
    $this->dao = new UserDao();
    $this->accountDao = new AccountDao();
  }

  public function register($user){
    if(!isset($user['account'])) throw new Exception ("Account field is required");

    try{
      $this->dao->beginTransaction();
      $account = $this->accountDao->add([
        "username" => $user['account'],
        "created_at" => date(Config::DATE_FORMAT),
        "status" => "PENDING"
      ]);

      $user = parent::add([
        "account_id" => $account['id'],
        "name" => $user['name'],
        "email" => $user['email'],
        "password" => $user['password'],
        "status" => "PENDING",
        "role" => "USER",
        "created_at" => date(Config::DATE_FORMAT),
        "token" => md5(random_bytes(16))
      ]);
      $this->dao->commit();
    } catch (Exception $e){
      $this->dao->rollBack();
      if(str_contains($e->getMessage(), 'accounts.username_UNIQUE')){
        throw new Exception("Account with the same email already exists in the database", 400, $e);
      }else{
        throw $e;
      }
    }
  // TODO: send email with some token
    return $user;
  }

  public function confirm($token){
    $user = $this->dao->get_user_by_token($token);
    if(!isset($user['id'])) throw Exception("Invalid token");

    $this->dao->update($user['id'], ["status" => "ACTIVE"]);
    $this->accountDao->update($user['id'], ["status" => "ACTIVE"]);
    // TODO send email to customer
  }

}

?>
