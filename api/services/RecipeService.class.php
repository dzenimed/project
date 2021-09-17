<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/RecipesDao.class.php';
require_once dirname(__FILE__).'/../dao/RecipeCategoryDao.class.php';

class RecipeService extends BaseService{

  public function __construct(){
    $this->dao = new RecipesDao();
  }

  public function get_recipe_by_user_id($user_id){
      return $this->dao->get_recipe_by_user_id($user_id);
  }

  public function get_recipe($offset, $limit, $search, $order, $total=FALSE){
    if($search){
      return $this->dao->get_recipe_by_name($offset, $limit, $search, $order, $total);
    }else{
      return $this->dao->get_all($offset, $limit, $order, $total);
    }
  }

  public function update_recipe($user, $id, $recipe){
    $db_recipe = $this->dao->get_by_id($id);
    if ($db_recipe['account_id'] != $user['aid']){
      throw new Exception("Invalid recipe", 403);
    }
    return $this->update($id, $recipe);
  } 

// CAUSES ERROR
/*
  public function add_recipe($user, $recipe){
      try {
      $data =[
        "recipe_name" => $recipe["recipe_name"],
        "preparation_steps" => $recipe["preparation_steps"],
        "tips" => $recipe["tips"],
        "created_at" => date(Config::DATE_FORMAT),
        "user_id" => Flight::get('user')[id]
      ];
        return parent::add($data);
      } catch (\Exception $e) {
          throw new Exception($e->getMessage(), 400, $e);
        }
      }
  } */

}

?>
