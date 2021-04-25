<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/RecipeCategoryDao.class.php';

class recipeCategoryService extends BaseService{

  public function __construct(){
    $this->dao = new RecipeCateogryDao();
  }

  public function add($recipesCategory){
    try {
      return parent::add($recipesCategory);
    } catch (\Exception $e) {                      // needed ?
      if(str_contains($e->getMessage(), 'recipecategory.id_UNIQUE')){
        throw new Exception("Recipe category was already created", 400, $e);
      }else{
        throw $e;
      }
      print_r($e);
      die;
    }
  }

  public function get_categories($search, $offset, $limit){
    if($search){
      return $this->dao->get_categories($search, $offset, $limit);
    }else{
      return $this->dao->get_all($offset, $limit, $order);
    }
  }

}


?>
