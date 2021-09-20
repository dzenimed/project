<?php

/**
 * @OA\Get(path="/recipeCategory", tags={"recipeCategory"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", name="search", description="Search string for category. Case insensitive search."),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List categories from database")
 * )
 */
Flight::route('GET /recipeCategory', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');

  $total =Flight::recipeCategoryService()->get_categories($offset, $limit, $search, $order, TRUE);
  header('total-records: ' . $total['total']);
  Flight::json(Flight::recipeCategoryService()->get_categories($offset, $limit, $search, $order));
});

/**
 * @OA\Post(path="/admin/recipeCategory", tags={"x-admin", "recipeCategory"}, security={{"ApiKeyAuth": {}}},
 *   @OA\RequestBody(description="Add recipe category info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *              @OA\Property(property="category_name", requierd=true, type="string", example="Vegan", description="Name of the category"),
 *              @OA\Property(property="category_description", requierd=true, type="string", example="No animal products allowed", description="Category description"),
 *             )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Save recipe category")
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
*    		       @OA\Property(property="category_name", requierd=true, type="string", example="Vegan", description="Name of the category"),
*              @OA\Property(property="category_description", requierd=true, type="string", example="No animal products allowed", description="Category description"),
 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Update category")
 * )
 */
Flight::route('PUT /admin/recipeCategory/@id', function($id){
  Flight::json(Flight::recipeCategoryService()->update(intval($id), Flight::request()->data->getData()));
});

?>
