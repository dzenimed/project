<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/RecipeIngredientsDao.class.php';

class RecipeIngredientService extends BaseService{

  public function __construct(){
    $this->dao = new RecipeIngredientsDao();
    $this->recipeDao = new RecipesDao();
  }

  public function get_ingredients($offset, $limit, $search, $order, $total = FALSE){
    if($search){
      return $this->dao->get_ingredients($offset, $limit, $search, $order, $total);
    }else{
      return $this->dao->get_all($offset, $limit, $order, $total);
    }
  }

  public function add($ingredient){
    try{
      $data = [
       "ingredient_name" => $ingredient["ingredient_name"],
       "measurement" => $ingredient["measurement"],
       "recipe_id" => $this->recipeDao->get_recipe_by_id($id)
     ];
     return parent::add($data);
   }catch (\Exception $e){
       throw new Exception($e->getMessage(), 400, $e);
   }
 }

}


?>
