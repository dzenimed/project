<?php

Flight::route('GET /recipes', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $recipe_name = Flight::query('recipe_name');
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');
  Flight::json(Flight::recipeService()->get_recipe($recipe_name, $offset, $limit, $search, $order));

//  Flight::json(Flight::recipeService()->get_recipe());
});

// Doesn't work properly, Check why v5, 30 min
Flight::route('POST /recipes', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::recipeService()->add($data));
});



?>
