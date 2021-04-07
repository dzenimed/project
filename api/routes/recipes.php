<?php

Flight::route('GET /recipes', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  // use something else instead to fetch account that uploaded the recipe
//  $account_id = Flight::query('account_id');
//  Flight::json(Flight::recipeService()->get_recipe($account_id, $offset, $limit));
  Flight::json(Flight::recipeService()->get_recipe());
});
// Doesn't work properly, Check why v5, 30 min
Flight::route('POST /recipes', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::recipeService()->add($data));
});



?>
