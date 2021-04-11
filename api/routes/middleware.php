<?php

// ROUTE BASED MIDDLEWARE
Flight::route("*", function(){
  if(str_starts_with(Flight::request()->url, '/users/')) return TRUE;

  $headers = getallheaders();
  $token = @$headers['Authentication'];
  try {
    $decoded = (array)\Firebase\JWT\JWT::decode($token,"JWT SECRET", ['HS256']);
    Flight::set('user', $decoded);
    // ADMIN -> set of routes for admin
    // USER  -> set of routes for user
    // USER_READ_ONLY -> set of routes except for PUT or POST
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});

/*
// FILTER BASED MIDDLEWARE
Flight::before('start', function(&$params, &$output){

  if(Flight::request()->url == '/swagger') return TRUE;

  if(str_starts_with(Flight::request()->url, '/users/')) return TRUE;

  $headers = getallheaders();
  $token = @$headers['Authentication'];
  try {
    $decoded = (array)\Firebase\JWT\JWT::decode($token,"JWT SECRET", ['HS256']);
    Flight::set('user', $decoded);
    // ADMIN -> set of routes for admin
    // USER  -> set of routes for user
    // USER_READ_ONLY -> set of routes except for PUT or POST
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});
*/

?>
