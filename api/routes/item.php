<?php

/**
 * @OA\Get(path="/item", tags={"item"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", name="search", description="Search string for item. Case insensitive search."),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List items from database")
 * )
 */
Flight::route('GET /item', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');

  $total =Flight::itemService()->get_item($offset, $limit, $search, $order, TRUE);
  header('total-records: ' . $total['total']);
  Flight::json(Flight::itemService()->get_item($offset, $limit, $search, $order));
});


/**
 * @OA\Get(path="/item/{recipe_id}", tags={"item"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of recipe"),
 *     @OA\Response(response="200", description="Fetch individual item by recipe.")
 * )
 */
 //not working
Flight::route('GET /item/@recipe_id', function($recipe_id){
    Flight::json(Flight::itemService()->get_item_by_recipe_id($recipe_id));
});

/**
*  @OA\Post(path="/item", tags={"item"}, security={{"ApiKeyAuth":{}}},
*   @OA\RequestBody(description="Add item of your own after creating the recipe for it.", required=true,
*     @OA\MediaType(mediaType="application/json",
*    		@OA\Schema(
*    		  @OA\Property(property="title", requierd=true, type="string", example="ItemName", description="Name of the item"),
*    		  @OA\Property(property="description", requierd=true, type="string", example="Burrito filled with vegan ingredients", description="Description of item"),
*    		  @OA\Property(property="preparation_time", requierd=true, type="string", example="50 minutes", description="Time required to prepare item"),
*    		  @OA\Property(property="difficulty_lvl", requierd=true, type="int", example="4", description="Level of difficulty (1-easy, 5-hard)"),
*         @OA\Property(property="image_src", requierd=true, type="string", example="https:www....", description="Link to photo of item"),
*         @OA\Property(property="recipe_id", requierd=true, type="int", example="21", description="Recipe id"),
*         @OA\Property(property="category_id", requierd=true, type="int", example="4", description="Category id")
*         )
*     )
*      ),
 *  @OA\Response(response="200", description="Item has been created.")
 * )
 */
Flight::route('POST /item', function(){
  $data = Flight::request()->data->getData();
//  Flight::json(Flight::itemService()->add_i($data));
  Flight::json(Flight::itemService()->add($data));
});


/**
 * @OA\Get(path="/item/{id}", tags={"item"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of item"),
 *     @OA\Response(response="200", description="Fetch individual item by id.")
 * )
 */
Flight::route('GET /item/@id', function($id){
  Flight::json(Flight::itemService()->get_by_id($id));
});

/**
* @OA\Get(path="/item/category_name", tags={"item"}, security={{"ApiKeyAuth":{}}},
*     @OA\Parameter(@OA\Schema(type="string"), in="query", name="category_name", description="Category name you are looking for"),
*     @OA\Response(response="200", description="List items from database based on their category")
* )
*/
Flight::route('GET /item/category_name', function(){
  $category_name = Flight::query('category_name');
//  Flight::json(Flight::itemService()->get_item_sorted_by_category($category_name);
});

?>
