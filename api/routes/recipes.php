<?php

/**
 * @OA\Get(path="/user/recipes", tags={"x-user", "recipes"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", recipe_name="search", description="Search string for recipes. Case insensitive search."),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List accounts from database")
 * )
 */
Flight::route('GET /user/recipes', function(){
  $account_id = Flight::get('user')['aid'];
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');

  Flight::json(Flight::recipeService()->get_recipe($account_id, $offset, $limit, $search, $order));
});

/**
 * @OA\Get(path="/user/recipes/@id", tags={"x-user", "recipes"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of recipe"),
 *     @OA\Response(response="200", description="Fetch individual recipe by category")
 * )
 */
Flight::route('GET /user/recipes/@id', function($id){
    Flight::json(Flight::recipeService()->get_recipe_by_account_and_id($account_id, $id));
});


// Doesn't work properly, Check why v5, 30 min; NOT NEEDED because of other POST route
/*Flight::route('POST /user/recipes', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::recipeService()->add($data));
}); */


/**
*  @OA\Post(path="/recipes/add", tags={"recipes"},
*   @OA\RequestBody(description="Add recipe of your own", required=true,
*     @OA\MediaType(mediaType="application/json",
*    		@OA\Schema(
*         @OA\Property(property="recipe", requierd=true, type="string", example="My Recipe", description="Recipe of the user"),
*    		  @OA\Property(property="recipe_name", requierd=true, type="string", example="RecipeName", description="Name of the recipe"),
*    		  @OA\Property(property="recipe_difficulty_level", requierd=true, type="int", example="1-5", description="Level of dificulty"),
*         @OA\Property(property="description", requierd=true, type="string", example="Preheat the owen at 200 degrees...", description="Preparation steps"),
*         @OA\Property(property="ingredients_list", requierd=true, type="string", example="eggs,salt,milk...", description="Ingredients required for recipe"),
*         @OA\Property(property="measurements", requierd=true, type="string", example="2, pinch of, 1,5 l", description="Measurements for all ingredients"),
*         @OA\Property(property="tips", requierd=true, type="string", example="My tip is to ...", description="Tips and tricks to make the recipe preparation easier"),
*         )
*     )
*      ),
 *  @OA\Response(response="200", description="Recipe has been created.")
 * )
 */
Flight::route('POST /recipes/add', function(){
  $data = Flight::request()->data->getData();
  Flight::recipeService()->add($data);
  Flight::json(["message" => "Recipe has been added to database."]);
}); // needed?

/**
 * @OA\Put(path="/user/recipes/{id}", tags={"x-user", "recipes"}, security={{"ApiKeyAuth":{}}},
 *  @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic recipe info that is going to be updated", required=true,
 *     @OA\MediaType(mediaType="application/json",
 *    		@OA\Schema(
 *    		  @OA\Property(property="recipe_name", requierd=true, type="string", example="RecipeName", description="Name of the recipe"),
 *    		  @OA\Property(property="recipe_difficulty_level", requierd=true, type="int", example="1-5", description="Level of dificulty"),
 *          @OA\Property(property="description", requierd=true, type="string", example="Preheat the owen at 200 degrees...", description="Preparation steps"),
 *          @OA\Property(property="ingredients_list", requierd=true, type="string", example="eggs,salt,milk...", description="Ingredients required for recipe"),
 *          @OA\Property(property="measurements", requierd=true, type="string", example="2, pinch of, 1,5 l", description="Measurements for all ingredients"),
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
 *     @OA\Parameter(type="integer", in="query", name="id", default=0, description="Recipe ID"),
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for recipe. Case insensitive search."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List email templates for user")
 * )
 */
Flight::route('GET /admin/email_templates', function(){
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
 *             @OA\Property(property="recipe", requierd=true, type="string", example="My Recipe", description="Recipe of the user"),
*    		       @OA\Property(property="recipe_name", requierd=true, type="string", example="RecipeName", description="Name of the recipe"),
*    		       @OA\Property(property="recipe_difficulty_level", requierd=true, type="int", example="1-5", description="Level of dificulty"),
*              @OA\Property(property="description", requierd=true, type="string", example="Preheat the owen at 200 degrees...", description="Preparation steps"),
*              @OA\Property(property="ingredients_list", requierd=true, type="string", example="eggs,salt,milk...", description="Ingredients required for recipe"),
*              @OA\Property(property="measurements", requierd=true, type="string", example="2, pinch of, 1,5 l", description="Measurements for all ingredients"),
*              @OA\Property(property="tips", requierd=true, type="string", example="My tip is to ...", description="Tips and tricks to make the recipe preparation easier"),
*              @OA\Property(property="category_id", requierd=true, type="string", example="1", description="Category ID"),
*              @OA\Property(property="account_id", requierd=true, type="string", example="1", description="The account id of person submitting recipe"),
 *             )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Saved recipe")
 * )
 */
Flight::route('POST /admin/recipes', function(){
  Flight::json(Flight::emailTemplateService()->add(Flight::request()->data->getData()));
});

/**
 * @OA\Put(path="/admin/recipes/{id}", tags={"x-admin", "reicpes"}, security={{"ApiKeyAuth": {}}},
 *   @OA\Parameter(type="integer", in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic recipe info that is going to be updated", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="recipe", requierd=true, type="string", example="My Recipe", description="Recipe of the user"),
*    		       @OA\Property(property="recipe_name", requierd=true, type="string", example="RecipeName", description="Name of the recipe"),
*    		       @OA\Property(property="recipe_difficulty_level", requierd=true, type="int", example="1-5", description="Level of dificulty"),
*              @OA\Property(property="description", requierd=true, type="string", example="Preheat the owen at 200 degrees...", description="Preparation steps"),
*              @OA\Property(property="ingredients_list", requierd=true, type="string", example="eggs,salt,milk...", description="Ingredients required for recipe"),
*              @OA\Property(property="measurements", requierd=true, type="string", example="2, pinch of, 1,5 l", description="Measurements for all ingredients"),
*              @OA\Property(property="tips", requierd=true, type="string", example="My tip is to ...", description="Tips and tricks to make the recipe preparation easier"),
 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Update recipe")
 * )
 */
Flight::route('PUT /admin/recipes/@id', function($id){
  Flight::json(Flight::emailTemplateService()->update($id, Flight::request()->data->getData()));
});

?>
