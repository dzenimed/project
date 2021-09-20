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
     $data = [
       "title" => $feedback["title"],
       "text" => $feedback["text"],
       "date_created" => date(Config::DATE_FORMAT),
       "account_id" => $user['aid'],
       "recipe_id" => $feedback["recipe_id"]
     ];
     return parent::add($data);
   } catch (\Exception $e) {
       throw new Exception($e->getMessage(), 400, $e);
   }
 }

  public function update_feedback($user, $id, $feedback){
    $db_feedback = $this->dao->get_by_id($id);
    if ($db_feedback['account_id'] != $user['aid']){
      throw new Exception("You cannot update someone elses comment!", 403);
    }
    return $this->update($id, $recipe);
  }

}


?>
