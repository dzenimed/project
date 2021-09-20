<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class RecipeIngredientsDao extends BaseDao{

  public function __construct(){
    parent::__construct("ingredients");
  }


  public function get_ingredients($offset, $limit, $search, $order, $total=FALSE){
    list($order_column, $order_direction) = self::parse_order($order);
    $params = [];
    if ($total){
      $query = "SELECT COUNT(*) AS total ";
    }else{
      $query = "SELECT * ";
    }
    $query .= "FROM ingredients
               WHERE 1 = 1 ";

    if (isset($search)){
      $query .= "AND ( LOWER(ingredient_name) LIKE CONCAT('%', :search, '%'))";
      $params['search'] = strtolower($search);
    }

    if ($total){
      return $this->query_unique($query, $params);
    }else{
      $query .="GROUP BY recipe_id ORDER BY ${order_column} ${order_direction} ";
      $query .="LIMIT ${limit} OFFSET ${offset}";

      return $this->query($query, $params);
    }
  }

}
?>
