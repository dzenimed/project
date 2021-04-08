<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/RecipesDao.class.php';

class RecipeService extends BaseService{

  public function __construct(){
    $this->dao = new RecipesDao();
  }

  public function get_recipe($recipe_name, $offset, $limit, $search){
    return $this->dao->get_recipe($recipe_name, $offset, $limit, $search);
  }

/*
  public function get_recipe(){
    return $this->dao->get_all();
  } */

// add doesn't work properly, check why
  public function add($recipes){
    try {
      return parent::add($recipes);
    } catch (\Exception $e) {            // TODO: change so same user can't create same recipe
      if(str_contains($e->getMessage(), 'recipes.recipe_name_UNIQUE')){
        throw new Exception("Recipe was already created by same creator", 400, $e);
      }else{
        throw $e;
      }
      print_r($e);
      die;
    }
  }

}


?>
