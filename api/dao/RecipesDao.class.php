<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  RecipesDao extends BaseDao{

  public function __construct(){
    parent::__construct("recipes");
  }
 public function get_recipe_by_user_id($user_id){
    return $this->query_unique("SELECT * FROM recipes WHERE user_id = :user_id", ["user_id" => $user_id]);
  }
// not working
  public function get_recipe_by_id($id){
    return $this->get_by_id($id);
    // return $this->query_unique("SELECT * FROM recipes WHERE id = :id", ["id" => $id]);
  }

  public function get_recipe_by_name($offset, $limit, $search, $order, $total=FALSE){
    list($order_column, $order_direction) = self::parse_order($order);

    $params = [];
    if($total){
      $query = "SELECT COUNT(*) AS total ";
    }else{
      $query = "SELECT * ";
    }
    $query .= "FROM recipes
              WHERE 1=1 ";

    if(isset($search)){
      $query .= "AND (LOWER(recipe_name) LIKE CONCAT('%', :search, '%')) ";
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

}

?>
