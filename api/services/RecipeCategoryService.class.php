<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/RecipeCategoryDao.class.php';

class recipeCategoryService extends BaseService{

  public function __construct(){
    $this->dao = new RecipeCategoryDao();
  }

  public function get_categories($offset, $limit, $search, $order, $total = FALSE){
    if($search){
      return $this->dao->get_categories($offset, $limit, $search, $order, $total);
    }else{
      return $this->dao->get_all($offset, $limit, $order, $total);
    }
  }

  public function add($category){
    try{
      $data = [
       "category_name" => $category["category_name"],
       "category_description" => $category["category_description"]
         ];
     return parent::add($data);
   }catch (\Exception $e){
     if(str_contains($e->getMessage(), 'recipecategory.category_name_UNIQUE')){
       throw new Exception("Category with the same name already exists in the database", 400, $e);
     }else{
       throw new Exception($e->getMessage(), 400, $e);
     }
   }
 }

}


?>
