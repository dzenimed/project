<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class RecipeIngredientsDao extends BaseDao{

  public function __construct(){
    parent::__construct("recipe_ingredients");
  }

  public function get_recipeIngredients($account_id, $offset, $limit, $search, $order){
      list($order_column, $order_direction) = self::parse_order($order);
      $params = [];
      $query = "SELECT r.*, i.ingredient_name AS ingredient_name, mq.quantity_amount AS quantity_amount, mu.measuremenr_description
                FROM recipe_ingredients r JOIN
                     ingredients i ON i.id = r.ingredient_id JOIN
                     measurement_qty mq ON mq.id = r.measurement_qty_id
                     JOIN measurement_units mu ON mu.id = r.measurement_id
                WHERE 1 = 1 ";

      if ($ingredient_id){
        $params["ingredient_id"] = ingredient_id;
        $query .= "AND r.ingredient_id = :ingredient_id ";
      }

      if (isset($search)){
        $query .= "AND ( LOWER(i.ingredient_name) LIKE CONCAT('%', :search, '%')) " ;
        $params['search'] = strtolower($search);
      }

      $query .="ORDER BY ${order_column} ${order_direction} ";
      $query .="LIMIT ${limit} OFFSET ${offset}";

      return $this->query($query, $params);
    }

}
?>
