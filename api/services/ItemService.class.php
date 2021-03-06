<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/ItemDao.class.php';
require_once dirname(__FILE__).'/../dao/RecipeCategoryDao.class.php';

class ItemService extends BaseService{

  public function __construct(){
    $this->dao = new ItemDao();
  }

  public function get_item_by_id($id){
      return $this->dao->get_item_by_id($id);
  }

  public function get_item_by_recipe_id($recipe_id){
    return $this->dao->get_item_by_recipe_id($recipe_id);
  }

  public function get_item($offset, $limit, $search, $order, $total = FALSE){
    return $this->dao->get_item($offset, $limit, $search, $order, $total);
  }

  public function get_item_sorted_by_category($category_name){
    return $this->dao->get_item_sorted_by_category($category_name);
  }

  public function add($item){
    try{
      $data = [
       "title" => $item["title"],
       "description" => $item["description"],
       "preparation_time" => $item["preparation_time"],
       "difficulty_lvl" => $item["difficulty_lvl"],
       "image_src" => $item["image_src"],
       "category_id" => $item["category_id"],
       "recipe_id" => $item["recipe_id"]
         ];
     return parent::add($data);
    }catch(\Exception $e){
     throw new \Exception($e->getMessage(), 400, $e);
     }
 }

 // causes error
/*   public function add_i($title, $description, $preparation_time, $difficulty_lvl, $image_src, $recipe_name, $category_name){
     return $this->dao->add_item($title, $description, $preparation_time, $difficulty_lvl, $image_src, $recipe_name, $category_name);
   } */

}

?>
