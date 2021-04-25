<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/RecipesDao.class.php';
require_once dirname(__FILE__).'/../dao/RecipeCreatorDao.class.php';
require_once dirname(__FILE__).'/../dao/RecipeCategoryDao.class.php';

class RecipeService extends BaseService{
//  private $recipeCreatorDao = new RecipesDao();
  protected $recipeArr=array();

  public function __construct(){
    $this->dao = new RecipesDao();
  }

  public function get_recipe($recipe_name, $offset, $limit, $search, $order){
    return $this->dao->get_recipe($recipe_name, $offset, $limit, $search, $order);
  }

/*
  public function get_recipe(){
    return $this->dao->get_all();
  } */

// add doesn't work properly, check why
/*  public function add($recipes){
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
  }*/
/*
  public function add($recipe){
    if(!isset($recipe['recipecreator'])) throw new Exception ("Account field is required");

    try{
      $this->dao->beginTransaction();
      $recipecreator = $this->recipeCreatorDao->add([
        "submission_name" => $recipe['recipecreator'],
        "created_at" => date(Config::DATE_FORMAT)
      ]);

      $recipe = parent::add([
        "recipe_name" => $recipe['recipe_name'],
        "recipe_difficulty_level" => "0", // entered by user also
        "password" => md5($user['password']),
        "description" => "",
    /*    $newrecipeArr = array();                       // figure out how to incorporate these values in array (milk=>2 l)
        foreach($recipeArr as $key=>$value) {
          $newrecipeArr[$key]['ingredients_list'] = $value['ingredients_list'];
          $newrecipeArr[$key]['measurements'] = $value['measurements'];
        } */
      /*  $recipe =.parent::add([ */
/*        "ingredients_list" => $newrecipeArr[$key]['ingredients_list'],
        "measurements" => $newrecipeArr[$key],
        "tips" => "",
        "number_of_submission" => $recipecreator['number_of_submission']
      ]);
      $this->dao->commit();
    } catch (\Exception $e){
      $this->dao->rollBack();
      if(str_contains($e->getMessage(), 'recipecreator.submission_name_UNIQUE')){      // correct?
        throw new Exception("Recipe with the same submission name already exists in the database", 400, $e);
      }else{
        throw $e;
      }
    }
//   $this->smtpClient->send_register_user_token($user); not needed?

    return $recipe;
  }
*/

}


?>
