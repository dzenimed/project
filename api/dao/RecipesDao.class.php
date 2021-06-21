<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  RecipesDao extends BaseDao{

  public function __construct(){
    parent::__construct("recipes");
  }

  public function get_recipe_by_account_and_id($account_id, $id){
    return $this->query_unique("SELECT * FROM recipes WHERE account_id = :account_id AND id = :id", ["account_id" => $account_id, "id" => $id]);
  }

  public function get_recipe($account_id, $offset, $limit, $search, $order){
    list($order_column, $order_direction) = self::parse_order($order);

    $params = [];
    $query = "SELECT * FROM recipes
                        WHERE 1=1 ";

    if($account_id){
        $params["account_id"] = $account_id;
        $query .= "AND account_id = :account_id ";
    }

    if(isset($search)){
      $query .= "AND recipe_difficulty_level LIKE CONCAT('%', :search, '%') ";
      $params['search'] = $search;           //strtolower($search);
    }

    $query .="ORDER BY ${order_column} ${order_direction} ";
    $query .="LIMIT ${limit} OFFSET ${offset}";

    return $this->query($query, $params);
  }
}
?>
