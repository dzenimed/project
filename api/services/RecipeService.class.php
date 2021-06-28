<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/RecipesDao.class.php';
require_once dirname(__FILE__).'/../dao/RecipeCategoryDao.class.php';

class RecipeService extends BaseService{

  public function __construct(){
    $this->dao = new RecipesDao();
  }

  public function get_recipe_by_account_and_id($account_id, $id){
      return $this->dao->get_recipe_by_account_and_id($account_id, $id);
  }

  public function get_recipe($account_id, $offset, $limit, $search, $order, $total = FALSE){
    return $this->dao->get_recipe($account_id, $offset, $limit, $search, $order, $total);
  }

  public function update_recipe($user, $id, $recipe){
    $db_recipe = $this->dao->get_by_id($id);
    if ($db_recipe['account_id'] != $user['aid']){
      throw new Exception("Invalid recipe", 403);
    }
    return $this->update($id, $recipe);
  }

// add doesn't work properly, check why
  public function add_recipe($user, $recipe){
      try {
      $data =[
        "recipe_name" => $recipe['recipe_name'],
        "recipe_difficulty_level" => $recipe['recipe_difficulty_level'],
        "description" => $recipe['description'],
        "tips" => $recipe['tips'],
        "created_at" => date(Config::DATE_FORMAT),
        "category_id" => $recipe['category_id'],
        "account_id" => $user['aid']
      ];
        return parent::add($data);
      } catch (\Exception $e) {
        if(str_contains($e->getMessage(), 'recipes.recipe_name_UNIQUE')){
          throw new Exception("Recipe with the same name was already created.", 400, $e);
        }else{
          throw new Exception($e->getMessage(), 400, $e);
        }
      }
  }
/*
  public function get_by_id(){
  } */
}

?>
