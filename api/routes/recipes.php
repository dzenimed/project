<?php

Flight::route('POST /recipes', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::recipeService()->add($data));
});



?>
