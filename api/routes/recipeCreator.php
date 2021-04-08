<?php

Flight::route('GET /recipeCreator', function(){

  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $number_of_submission = Flight::query('number_of_submission');
  $search = Flight::query('search');
  Flight::json(Flight::recipeCreatorService()->get_recipeCreator($number_of_submission, $offset, $limit, $search));

});

?>
