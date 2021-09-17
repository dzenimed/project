<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  ItemDao extends BaseDao{

  public function __construct(){
    parent::__construct("item");
  }

  public function get_item_by_id($id){
    return $this->get_by_id($id);
  //  return $this->query("SELECT * FROM item WHERE id = :id", ["id" => $id]);
  }

 public function get_item_by_recipe_id($recipe_id){
    return $this->query_unique("SELECT * FROM item WHERE recipe_id = :recipe_id", ["recipe_id" => $recipe_id]);
  }

  public function get_item($offset, $limit, $search, $order, $total=FALSE){
    list($order_column, $order_direction) = self::parse_order($order);

    $params = [];
    if($total){
      $query = "SELECT COUNT(*) AS total ";
    }else{
      $query = "SELECT * ";
    }
    $query .= "FROM item
              WHERE 1 = 1 ";

    if(isset($search)){
      $query .= "AND (LOWER(title) LIKE CONCAT('%', :search, '%') OR LOWER(description) LIKE CONCAT('%', :search, '%')) OR difficulty_lvl = :search OR category_id = :search ";
      $params['search'] = strtolower($search);
    }

    if ($total){
      return $this->query_unique($query, $params);
    }else{
      $query .="ORDER BY ${order_column} ${order_direction} ";
      $query .="LIMIT ${limit} OFFSET ${offset}";

      return $this->query($query, $params);
    }
  }

    public function add_item($title, $description, $preparation_time, $difficulty_lvl, $image_src, $recipe_name, $category_name){
      $query = "INSERT INTO item(title, description, preparation_time, difficulty_lvl, image_src, recipe_id, category_id)
                  VALUES ( ".$title.", '".$description."', '".$preparation_time."', '".$difficulty_lvl."', '".$image_src."',
                  (SELECT id FROM mydb.recipes WHERE recipe_name = '".$recipe_name."'),
                  (SELECT id FROM mydb.recipecategory WHERE category_name = '".$category_name."') );";

      $stmt= $this->connection->prepare($query);
      $params=["title" => $title, "description" => $description, "preparation_time" => $preparation_time, "difficulty_lvl" => $difficulty_lvl,
      "image_src" => $image_src, "recipe_name" => $recipe_id, "category_name" => $category_id];
      $stmt->execute($params);
    }
/*
  public function add_i($title, $description, $preparation_time, $difficulty_lvl, $image_src, $recipe_name, $category_name){
    return $this->add_item($title, $description, $preparation_time, $difficulty_lvl, $image_src, $recipe_name, $category_name);
  } */

   /* potential way for displaying data using join
SELECT title, tips, category_name, category_description FROM mydb.item i
INNER JOIN mydb.recipes r
ON i.recipe_id=r.id
INNER JOIN mydb.recipecategory c
ON i.category_id=c.id; */
}
?>