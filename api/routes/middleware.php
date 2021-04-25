<?php

// ROUTE BASED MIDDLEWARE
Flight::route("/users/*", function(){
//  if(str_starts_with(Flight::request()->url, '/users/')) return TRUE;
  try {
    $user = (array)\Firebase\JWT\JWT::decode(Flight::header("Authentication"), Config::JWT_SECRET, ['HS256']);
    if (Flight::request()->method != "GET" && $user["r"] == "USER_READ_ONLY"){
      throw new Exception("Read only user can't change anything.", 403);
    }
    Flight::set('user', $user);
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});

Flight::route("/admin/*", function(){
  try {
    $decoded = (array)\Firebase\JWT\JWT::decode(Flight::header("Authentication"), Config::JWT_SECRET, ['HS256']);
    if ($user['r'] != "ADMIN"){
     throw new Exception("Admin access required", 403);
   }
    Flight::set('user', $decoded);
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

// any user routes that dont require token, can be executed
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
