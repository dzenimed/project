<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  RecipeCreatorDao extends BaseDao{
  public function __construct(){
    parent::__construct("recipecreator");
  }

  public function get_recipeCreator($number_of_submission, $offset, $limit){
    return $this->query("SELECT * FROM recipecreator
                        WHERE number_of_submission = :number_of_submission
                        LIMIT ${limit} OFFSET ${offset}",
                        ["number_of_submission" => $number_of_submission]);
  }

}
?>
