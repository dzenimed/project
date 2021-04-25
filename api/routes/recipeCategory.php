<?php

/**
 * @OA\Get(path="/recipecategory", tags={"recipecateogry"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", name="search", description="Search string for accounts. Case insensitive search."),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List accounts from database")
 * )
 */
Flight::route('GET /recipeCategory', function(){

  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $id = Flight::query('id');
  $search = Flight::query('search');
  Flight::json(Flight::recipeCategoryService()->get_categories($search, $offset, $limit, $search));

});

?>
