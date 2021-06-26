<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once dirname(__FILE__).'/services/AccountService.class.php';
require_once dirname(__FILE__).'/services/UserService.class.php';
require_once dirname(__FILE__).'/services/RecipeService.class.php';
require_once dirname(__FILE__).'/services/FeedbackService.class.php';


Flight::set('flight.log_errors', TRUE);

// error handling for our API
/*Flight::map('error', function(Exception $ex){
  Flight::json(["message" => $ex->getMessage()], $ex->getCode() ? $ex->getCode() : 500);
});

/* utility function for reading query parameters from URL */
Flight::map('query', function($name, $default_value = NULL){
  $request = Flight::request();
  $query_param = @$request->query->getData()[$name];
  $query_param = $query_param ? $query_param : $default_value;
  return urldecode($query_param);
});


Flight::route('GET /swagger', function(){
  $openapi = @\OpenApi\scan(dirname(__FILE__)."/routes");
  header('Content-Type: application/json');
  echo $openapi->toJson();
});

Flight::route('GET /', function(){
  Flight::redirect('/docs');
});

/* register Business Logic layer services */
Flight::register('accountService', 'AccountService');
Flight::register('userService', 'UserService');
Flight::register('recipeService', 'RecipeService');
Flight::register('feedbackService', 'FeedbackService');

Flight::register('recipeCreatorService', 'RecipeCreatorService');
Flight::register('recipeCategoryService', 'RecipeCategoryService');


/* include all routes */
require_once dirname(__FILE__)."/routes/middleware.php";
require_once dirname(__FILE__)."/routes/accounts.php";
require_once dirname(__FILE__)."/routes/users.php";
require_once dirname(__FILE__)."/routes/recipes.php";
require_once dirname(__FILE__)."/routes/feedback.php";

require_once dirname(__FILE__)."/routes/recipeCategory.php";


Flight::start();

?>
