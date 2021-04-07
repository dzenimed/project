<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  RecipesDao extends BaseDao{

  public function __construct(){
    parent::__construct("recipes");
  }

  public function getRecipe_by_id($id){
    return $this->query_unique("SELECT * FROM recipes WHERE id=:id", ["id" => $id]);
  }

  public function update_recipe($id, $recipe){
      $this->update("recipes", $id, $recipe); // needs work
  }

}
?>
