<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  QuestionsAndAnswers extends BaseDao{

  public function __construct(){
    parent::__construct("QuestionsAndAnswers");
  }

  public function getFeedback($id){
    return $this->query_unique("SELECT * FROM QuestionsAndAnswers WHERE id=:id", ["id" => $id]);
  }


}
?>
