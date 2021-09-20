<?php

/**
 * @OA\Get(path="recipes", tags={"recipes"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", name="search", description="Search string for recipes. Case insensitive search."),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List recipes from database")
 * )
 */
Flight::route('GET /recipes', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');

  $total =Flight::recipeService()->get_recipe($offset, $limit, $search, $order, TRUE);
  header('total-records: ' . $total['total']);
  Flight::json(Flight::recipeService()->get_recipe($offset, $limit, $search, $order));
});

/**
 * @OA\Post(path="/user/recipes", tags={"x-user", "recipes"}, security={{"ApiKeyAuth": {}}},
 *   @OA\RequestBody(description="Add basic recipe info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
*    		       @OA\Property(property="recipe_name", requierd=true, type="string", example="RecipeName", description="Name of the recipe"),
*    		       @OA\Property(property="preparation_steps", requierd=true, type="string", example="Preheat the oven to... Prepare the..", description="Step by step guide to making the recipe"),
*              @OA\Property(property="tips", requierd=true, type="string", example="My tip is to ...", description="Tips and tricks to make the recipe preparation easier")
 *             )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Saved recipe")
 * )
 */
// Add not working
Flight::route('POST /user/recipes', function(){
  Flight::json(Flight::recipeService()->add_recipe(Flight::request()->data->getData()));
});

/**
 * @OA\Put(path="/recipes/{id}", tags={"recipes"}, security={{"ApiKeyAuth": {}}},
 *   @OA\Parameter(type="integer", in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic recipe info that is going to be updated", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    			@OA\Property(property="recipe_name", requierd=true, type="string", example="RecipeName", description="Name of the recipe"),
 *    		  @OA\Property(property="preparation_steps", requierd=true, type="string", example="Preheat the oven to... Prepare the..", description="Step by step guide to making the recipe"),
 *          @OA\Property(property="tips", requierd=true, type="string", example="My tip is to ...", description="Tips and tricks to make the recipe preparation easier")
 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Update recipe")
 * )
 */
Flight::route('PUT /recipes/update/@id', function($id){
  Flight::json(Flight::recipeService()->update(intval($id), Flight::request()->data->getData()));
});

?>
