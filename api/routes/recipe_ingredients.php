<?php

/**
 * @OA\Get(path="/ingredients", tags={"ingredients"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", name="search", description="Search string for category. Case insensitive search."),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List ingredients from database")
 * )
 */
Flight::route('GET /ingredients', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');

  $total =Flight::recipeIngredientService()->get_ingredients($offset, $limit, $search, $order, TRUE);
  header('total-records: ' . $total['total']);
  Flight::json(Flight::recipeIngredientService()->get_ingredients($offset, $limit, $search, $order));
});

/**
 * @OA\Post(path="/ingredients", tags={"ingredients"}, security={{"ApiKeyAuth": {}}},
 *   @OA\RequestBody(description="Add ingredients info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *              @OA\Property(property="ingredient_name", requierd=true, type="string", example="cheese", description="Name of the ingredient"),
 *              @OA\Property(property="measurement", requierd=true, type="string", example="2 cups", description="How much of it to use"),
 *             )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Save ingredients list")
 * )
 */
Flight::route('POST /ingredients', function(){
  Flight::json(Flight::recipeIngredientService()->add(Flight::request()->data->getData()));
});


?>
