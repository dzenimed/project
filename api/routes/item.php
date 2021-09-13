<?php

/**
 * @OA\Get(path="/user/item", tags={"x-user", "item"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", recipe_name="search", description="Search string for item. Case insensitive search."),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List items from database")
 * )
 */
Flight::route('GET /user/item', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');

  $total =Flight::itemService()->get_item($offset, $limit, $search, $order, TRUE);
  header('total-records: ' . $total['total']);
  Flight::json(Flight::itemService()->get_item($offset, $limit, $search, $order));
});

/**
 * @OA\Get(path="/item/@id", tags={"x-user", "item"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of item"),
 *     @OA\Response(response="200", description="Fetch individual item by recipe.")
 * )
 */
Flight::route('GET /item/@id', function($id){
    Flight::json(Flight::itemService()->get_item_by_id($id));
});

/**
 * @OA\Get(path="/item/@recipe_id", tags={"x-user", "item"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of recipe"),
 *     @OA\Response(response="200", description="Fetch individual item by recipe.")
 * )
 */
Flight::route('GET /item/@recipe_id', function($recipe_id){
    Flight::json(Flight::itemService()->get_item_by_recipe_id($recipe_id));
});

// ovdje
/**
*  @OA\Post(path="/user/item", tags={"x-user", item"}, security={{"ApiKeyAuth":{}}},
*   @OA\RequestBody(description="Add item of your own", required=true,
*     @OA\MediaType(mediaType="application/json",
*    		@OA\Schema(
*    		  @OA\Property(property="recipe_name", requierd=true, type="string", example="RecipeName", description="Name of the recipe"),
*    		  @OA\Property(property="recipe_difficulty_level", requierd=true, type="int", example="1-5", description="Level of dificulty"),
*         @OA\Property(property="description", requierd=true, type="string", example="Preheat the owen at 200 degrees...", description="Preparation steps"),
*         @OA\Property(property="tips", requierd=true, type="string", example="My tip is to ...", description="Tips and tricks to make the recipe preparation easier")
*         )
*     )
*      ),
 *  @OA\Response(response="200", description="Recipe has been created.")
 * )
 */
Flight::route('POST /user/item', function(){
  Flight::json(Flight::recipeService()->add_recipe(Flight::get('user'), Flight::request()->data->getData()));
});

/**
 * @OA\Put(path="/user/recipes/{id}", tags={"x-user", "recipes"}, security={{"ApiKeyAuth":{}}},
 *  @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic recipe info that is going to be updated", required=true,
 *     @OA\MediaType(mediaType="application/json",
 *    		@OA\Schema(
 *    		  @OA\Property(property="recipe_name", requierd=true, type="string", example="RecipeName", description="Name of the recipe"),
 *    		  @OA\Property(property="recipe_difficulty_level", requierd=true, type="int", example="1-5", description="Level of dificulty"),
 *          @OA\Property(property="description", requierd=true, type="string", example="Preheat the owen at 200 degrees...", description="Preparation steps"),
 *          @OA\Property(property="tips", requierd=true, type="string", example="My tip is to ...", description="Tips and tricks to make the recipe preparation easier"),
 *          )
 *     )
 *      ),
 *     @OA\Response(response="200", description="Update recipe")
 * )
 */

Flight::route('PUT /user/recipes/@id', function($id){
  Flight::json(Flight::recipeService()->update_recipe(Flight::get('user'),$id, Flight::request()->data->getData()));
});


/**
 * @OA\Get(path="/admin/recipes", tags={"x-admin", "recipes"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="query", name="account_id", default=0, description="Account id"),
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for recipe. Case insensitive search."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List email templates for user")
 * )
 */
Flight::route('GET /admin/recipes', function(){
  $account_id = Flight::query('account_id');
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');

  Flight::json(Flight::recipeService()->get_recipe($account_id, $offset, $limit, $search, $order));
});

/**
 * @OA\Get(path="/admin/recipes/{id}", tags={"x-admin", "recipes"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of email template"),
 *     @OA\Response(response="200", description="Fetch individual email template")
 * )
 */
Flight::route('GET /admin/recipes/@id', function($id){
  Flight::json(Flight::recipeService()->get_by_id($id));         //TODO: add get_by_id in service class
});

/**
 * @OA\Post(path="/admin/recipes", tags={"x-admin", "recipes"}, security={{"ApiKeyAuth": {}}},
 *   @OA\RequestBody(description="Basic recipe info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
*    		       @OA\Property(property="recipe_name", requierd=true, type="string", example="RecipeName", description="Name of the recipe"),
*    		       @OA\Property(property="recipe_difficulty_level", requierd=true, type="int", example="1-5", description="Level of dificulty"),
*              @OA\Property(property="description", requierd=true, type="string", example="Preheat the owen at 200 degrees...", description="Preparation steps"),
*              @OA\Property(property="tips", requierd=true, type="string", example="My tip is to ...", description="Tips and tricks to make the recipe preparation easier")
 *             )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Saved recipe")
 * )
 */
Flight::route('POST /admin/recipes', function(){
  Flight::json(Flight::recipeService()->add(Flight::request()->data->getData()));
});

/**
 * @OA\Put(path="/admin/recipes/{id}", tags={"x-admin", "recipes"}, security={{"ApiKeyAuth": {}}},
 *   @OA\Parameter(type="integer", in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic recipe info that is going to be updated", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="recipe", requierd=true, type="string", example="My Recipe", description="Recipe of the user"),
*    		       @OA\Property(property="recipe_name", requierd=true, type="string", example="RecipeName", description="Name of the recipe"),
*    		       @OA\Property(property="recipe_difficulty_level", requierd=true, type="int", example="1-5", description="Level of dificulty"),
*              @OA\Property(property="description", requierd=true, type="string", example="Preheat the owen at 200 degrees...", description="Preparation steps"),
*              @OA\Property(property="tips", requierd=true, type="string", example="My tip is to ...", description="Tips and tricks to make the recipe preparation easier"),
 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Update recipe")
 * )
 */
Flight::route('PUT /admin/recipes/@id', function($id){
  Flight::json(Flight::recipeService()->update($id, Flight::request()->data->getData()));
});

?>
