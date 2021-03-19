<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  RecipesDao extends BaseDao{

  public function __construct(){
    parent::__construct("Recipes");
  }

  public function getRecipe_by_id($id){
    return $this->query_unique("SELECT * FROM Recipes WHERE id=:id", ["id" => $id]);
  }

  public function update_recipe($id, $recipe){
      $this->update("Recipe", $id, $recipe); // needs work
  }

}
?>
