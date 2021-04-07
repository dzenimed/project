<?php

Flight::route('POST /recipeCreator', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::recipeCreatorService()->add($data));
});

?>
