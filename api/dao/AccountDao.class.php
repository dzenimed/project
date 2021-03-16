<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  AccountDao extends BaseDao{

  pulic function __construct(){
    parent::__construct("account");
  }
  public function addAccount($account){

  }

  public function get_account_by_email($email){
    
  }
}
?>
