<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  RecipeCategoryDao extends BaseDao{

  public function __construct(){
    parent::__construct("recipecategory");
  }


  public function get_categories($offset, $limit, $search, $order, $total=FALSE){

    list($order_column, $order_direction) = self::parse_order($order);
    $params = [];
    if($total){
      $query = "SELECT COUNT(*) AS total ";
    }else{
      $query = "SELECT * ";
    }
    $query .= "FROM recipecategory
              WHERE 1 = 1 ";

    if(isset($search)){
      $query .= "AND LOWER(category_description) LIKE CONCAT('%', :search, '%') OR LOWER(category_name) LIKE CONCAT('%', :search, '%') ";
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

  public function update_description($id, $category_description){
    $query = "UPDATE recipecategory SET category_description = :category_description WHERE id = :id";
    $stmt = $this->connection->prepare($query);
    $params=["id" => $id, "category_description" => $category_description];
    $stmt->execute($params);
  }

}
?>
