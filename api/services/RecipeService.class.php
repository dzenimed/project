<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/RecipesDao.class.php';
require_once dirname(__FILE__).'/../dao/RecipeCategoryDao.class.php';

class RecipeService extends BaseService{

  public function __construct(){
    $this->dao = new RecipesDao();
  }

  public function get_recipe_by_user_id($user_id){
      return $this->dao->get_recipe_by_user_id($user_id);
  }

  public function get_recipe_by_id($id){
      return $this->dao->get_recipe_by_id($id);
  }

  public function get_recipe($offset, $limit, $search, $order, $total=FALSE){
    if($search){
      return $this->dao->get_recipe_by_name($offset, $limit, $search, $order, $total);
    }else{
      return $this->dao->get_all($offset, $limit, $order, $total);
    }
  }

  // error: Trying to access array offset on value of type null (400)

    public function add_recipe($recipe){
      try {
        $data =[
          "recipe_name" => $recipe["recipe_name"],
          "preparation_steps" => $recipe["preparation_steps"],
          "tips" => $recipe["tips"],
          "created_at" => date(Config::DATE_FORMAT),
          "user_id" => Flight::get('user')['id']
        ];
          return parent::add($data);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), 400, $e);
          }
      }


  /* once added,cant be updated
    public function update_preparation_steps($id, $preparation_steps){
      $query = "UPDATE recipes
                SET preparation_steps = :preparation_steps
                WHERE id = :id";
      $stmt = $this->connection->prepare($query);
      $params=["id" => $id, "preparation_steps" => $preparation_steps];
      $stmt -> execute($params);
    }*/


}

?>
