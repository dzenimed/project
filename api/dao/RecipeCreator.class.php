<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  RecipeCreator extends BaseDao{
  public function __construct(){
    parent::__construct("recipeCreators");
  }

public function get_all_creators(){
  return $this->query("SELECT * FROM recipeCreators", []);
}

}
?>
