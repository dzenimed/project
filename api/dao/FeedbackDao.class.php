<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  QuestionsAndAnswers extends BaseDao{

  public function __construct(){
    parent::__construct("feedback");
  }

  protected function getFeedback($id){
    return $this->query_unique("SELECT * FROM feedback WHERE id=:id", ["id" => $id]);
  }

  public function get_feedback($account_id, $offset, $limit, $search, $order){
    list($order_column, $order_direction) = self::parse_order($order);

    $params = [];
    $query = "SELECT f.*, a.username AS account_username, r.recipe_name AS recipe_name *
                            FROM feedback f JOIN
                            accounts a ON a.id = f.account_id JOIN
                            recipes r ON r.id = f.recipe_id
                            WHERE 1=1 ";

    if($account_id){
        $params["account_id"] = $account_id;
        $query .= "AND f.account_id = :account_id ";
    }

    if(isset($search)){
      $query .= "AND (LOWER(f.title)) LIKE CONCAT('%', :search, '%') OR
                     (LOWER(a.username)) LIKE CONCAT('%', :search, '%') OR
                     (LOWER(r.recipe_name)) LIKE CONCAT('%', :search, '%')";
      $params['search'] = strtolower($search);
    }

    $query .="ORDER BY ${order_column} ${order_direction} ";
    $query .="LIMIT ${limit} OFFSET ${offset}";

    return $this->query($query, $params);
  }

}
?>
