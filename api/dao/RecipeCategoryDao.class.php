<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  RecipeCategoryDao extends BaseDao{

  public function __construct(){
    parent::__construct("recipecategory");
  }

  public function get_category_by_name($category_name){
    return $this->query_unique("SELECT * FROM recipecategory WHERE category_name =: category_name", ["category_name"=>$category_name]);
  }

  public function get_categories($search, $offset, $limit, $order= '-id'){

    list($order_column, $order_direction) = self::parse_order($order);

    return $this->query("SELECT * FROM recipecategory
                        WHERE LOWER(category_description) LIKE CONCAT('%', :category_description, '%')
                        ORDER BY ${order_column} ${order_direction}
                        LIMIT ${limit} OFFSET ${offset}",
                        ["category_description"=>strtolower($search)]);
  }
/*
  public function get_recipe_category($id, $offset, $limit){
    return $this->query("SELECT * FROM recipecategory
                        WHERE id = :id
                        LIMIT ${limit} OFFSET ${offset}",
                        ["id" => $id]);
  }
*/
}
?>
