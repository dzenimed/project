<?php

Flight::route('GET /recipes', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $recipe_name = Flight::query('recipe_name');
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');

  Flight::json(Flight::recipeService()->get_recipe($recipe_name, $offset, $limit, $search, $order));
});

Flight::route('GET /recipes/@id', function($id){
    Flight::json(Flight::recipeService()->get_by_id($id));
});

// Doesn't work properly, Check why v5, 30 min
Flight::route('POST /recipes', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::recipeService()->add($data));
});

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
});

Flight::route('PUT /recipes/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::recipeService()->update($id, $data));
});

?>
