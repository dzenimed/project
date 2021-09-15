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

/*
  public function update_item($user, $id, $recipe){
    $db_recipe = $this->dao->get_by_id($id);
    if ($db_recipe['account_id'] != $user['aid']){
      throw new Exception("Invalid recipe", 403);
    }
    return $this->update($id, $recipe);
  }
  */


  public function add_item($item){
      try {
      $data = [
        "title" => $item['title'],
        "description" => $item['description'],
        "preparation_time" => $item['preparation_time'],
        "difficulty_lvl" => $item['difficulty_lvl'],
        "image_src" => $item['image_src'],
        "category_id" => Flight::get('recipecategory')['id'],
        "recipe_id" => Flight::get('recipes')['id']
      ];
        return parent::add($data);
      } catch (Exception $e) {
        if(empty($item['description'])){
          throw new Exception("You must describe the item!", 400, $e);
        }else{
          throw new Exception($e->getMessage(), 400, $e);
        }
      }
  }

  public function add_i($title, $description, $preparation_time, $difficulty_lvl, $image_src, $recipe_name, $category_name){
    $query = "INSERT INTO mdyb.item(title, description, preparation_time, difficulty_lvl, image_src, recipe_id, category_id)
              VALUES ( ".$title.", '".$description."', '".$preparation_time."', '".$difficulty_lvl."', '".$image_src."',
              (SELECT id FROM mydb.recipes WHERE recipe_name = '".$recipe_name."'),
              (SELECT id FROM mydb.recipecategory WHERE category_name = '".$category_name."') );";

    $stmt= $this->connection->prepare($query);    
    $stmt->exec($query);


  }
}

?>
