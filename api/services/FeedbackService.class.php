<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/FeedbackDao.class.php';

class FeedbackService extends BaseService{

  public function __construct(){
    $this->dao = new FeedbackDao();
  }

  public function get_feedback($account_id, $offset, $limit, $search, $order){
    return $this->dao->get_feedback($account_id, $offset, $limit, $search, $order);
  }

  public function add_feedback($user, $feedback){
   try {
     $feedback['account_id'] = $user['aid'];
//     $feedback['recipe_id'] = $user[''];  add a recipe here and route
     $feedback['date_created'] = date(Config::DATE_FORMAT);
     return parent::add($feedback);
   } catch (\Exception $e) {
       throw new Exception($e->getMessage(), 400, $e);
   }
 }


  public function get_feedback_by_account_and_id($account_id, $id){
      return $this->dao->get_feedback_by_account_and_id($account_id, $id);
  }

  public function update_feedback($user, $id, $feedback){
    $db_feedback = $this->dao->get_by_id($id);
    if ($db_feedback['account_id'] != $user['aid']){
      throw new Exception("Invalid feedback", 403);
    }
    return $this->update($id, $recipe);
  }

}


?>
