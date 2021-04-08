<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  RecipesDao extends BaseDao{

  public function __construct(){
    parent::__construct("recipes");
  }

  public function getRecipe_by_id($id){
    return $this->query_unique("SELECT * FROM recipes WHERE id=:id", ["id" => $id]);
  }

  public function get_recipe($recipe_name, $offset, $limit, $search, $order){
    list($order_column, $order_direction) = self::parse_order($order);

    $params = ["recipe_name" => $recipe_name];
    $query = "SELECT * FROM recipes
                        WHERE LOWER(recipe_name) = :recipe_name ";

    if(isset($search)){
      $query .= "AND recipe_difficulty_level LIKE CONCAT('%', :search, '%') ";
      $params['search'] = strtolower($search);
    }

    $query .="ORDER BY ${order_column} ${order_direction} ";
    $query .="LIMIT ${limit} OFFSET ${offset}";

    return $this->query($query, $params);
  }
}
?>
