<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/RecipeCreatorDao.class.php';

class RecipeCreatorService extends BaseService{

  public function __construct(){
    $this->dao = new RecipeCreatorDao();
  }

  public function add($recipesCreator){
    try {
      return parent::add($recipeCreator);
    } catch (\Exception $e) {                      // needed ?
      if(str_contains($e->getMessage(), 'recipecreator.number_of_submission_UNIQUE')){
        throw new Exception("Recipe was already created by same creator", 400, $e);
      }else{
        throw $e;
      }
      print_r($e);
      die;
    }
  }

  public function get_recipeCreator($number_of_submission, $offset, $limit){
    return $this->dao->get_recipeCreator($number_of_submission, $offset, $limit);
  }

}


?>
