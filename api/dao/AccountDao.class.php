<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  AccountDao extends BaseDao{

  public function addAccount($account){
    return $this->insert("accounts", $account);
  }

  public function updateAccount($id, $account){
    $this->update("account", $id, $account);
  }

  public function getAllAccounts(){
    return $this->query("SELECT * FROM account", []);
  }

  public function get_account_by_id($id){
    return $this->query_unique("SELECT * FROM account WHERE id =:id", ["id"=> $id]);
  }


}
?>
