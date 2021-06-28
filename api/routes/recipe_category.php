<?php

/**
 * @OA\Get(path="/user/recipeCategory", tags={"x-user", "recipeCategory"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", recipe_name="search", description="Search string for recipes. Case insensitive search."),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List accounts from database")
 * )
 */
Flight::route('GET /user/recipeCategory', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');

  Flight::json(Flight::recipeCategoryService()->get_categories($offset, $limit, $search, $order));
});


/**
 * @OA\Get(path="/admin/recipeCategory/{id}", tags={"x-admin", "recipeCategory"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of recipe category"),
 *     @OA\Response(response="200", description="Fetch individual email template")
 * )
 */
Flight::route('GET /admin/recipeCategory/@id', function($id){
  Flight::json(Flight::recipeCategoryService()->get_by_id($id));
});

/**
 * @OA\Post(path="/admin/recipeCategory", tags={"x-admin", "recipeCategory"}, security={{"ApiKeyAuth": {}}},
 *   @OA\RequestBody(description="Basic recipe category info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *              @OA\Property(property="recipe_name", requierd=true, type="string", example="Category Name", description="Name of the category"),
 *              @OA\Property(property="description", requierd=true, type="string", example="Vegan", description="Category description"),
 *             )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Saved recipe")
 * )
 */
Flight::route('POST /admin/recipeCategory', function(){
  Flight::json(Flight::recipeCategoryService()->add(Flight::request()->data->getData()));
});

/**
 * @OA\Put(path="/admin/recipeCategory/{id}", tags={"x-admin", "recipeCategory"}, security={{"ApiKeyAuth": {}}},
 *   @OA\Parameter(type="integer", in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic recipe info that is going to be updated", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
*    		       @OA\Property(property="recipe_name", requierd=true, type="string", example="Category Name", description="Name of the category"),
*              @OA\Property(property="description", requierd=true, type="string", example="Vegan", description="Category description"),
 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Update recipe")
 * )
 */
Flight::route('PUT /admin/recipeCategory/@id', function($id){
  Flight::json(Flight::recipeCategoryService()->update($id, Flight::request()->data->getData()));
});

?>
