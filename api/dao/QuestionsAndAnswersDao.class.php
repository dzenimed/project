<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  QuestionsAndAnswers extends BaseDao{

  public function __construct(){
    parent::__construct("questions_and_answers");
  }

  protected function getFeedback($id){
    return $this->query_unique("SELECT * FROM questions_and_answers WHERE id=:id", ["id" => $id]);
  }


}
?>
