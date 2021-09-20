<?php

/**
 * @OA\Get(path="/user/feedback", tags={"x-user", "feedback"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(@OA\Schema(type="integer"), in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", recipe_name="search", description="Search string for recipes. Case insensitive search."),
 *     @OA\Parameter(@OA\Schema(type="string"), in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List feedback/comments from database")
 * )
 */
Flight::route('GET /user/feedback', function(){
  $account_id = Flight::get('user')['aid'];
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');

  Flight::json(Flight::feedbackService()->get_feedback($account_id, $offset, $limit, $search, $order));
});

/**
*  @OA\Post(path="/user/feedback", tags={"feedback"}, security={{"ApiKeyAuth": {}}},
*   @OA\RequestBody(description="Add a question or answer of your own", required=true,
*     @OA\MediaType(mediaType="application/json",
*    		@OA\Schema(
*         @OA\Property(property="title", requierd=true, type="string", example="My Question/Answer", description="What the comment is about"),
*         @OA\Property(property="text", requierd=true, type="string", description="Q/A of the user"),
*         )
*     )
*      ),
 *  @OA\Response(response="200", description="Feedback/comment has been added")
 * )
 */
 Flight::route('POST /user/feedback', function(){
   Flight::feedbackService()->add_feedback(Flight::get('user'), Flight::request()->data->getData());
 });

/**
 * @OA\Put(path="/user/feedback/{id}", tags={"x-user", "feedback"}, security={{"ApiKeyAuth":{}}},
 *  @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic Q/A info that is going to be updated", required=true,
 *     @OA\MediaType(mediaType="application/json",
 *    		@OA\Schema(
 *         @OA\Property(property="text", requierd=true, type="string", example="My Question/Answer", description="Q/A of the user")
 *          )
 *     )
 *      ),
 *     @OA\Response(response="200", description="Update feedback/comment")
 * )
 */

Flight::route('PUT /user/feedback/@id', function($id){
  Flight::json(Flight::feedbackService()->update_feedback(Flight::get('user'),intval($id), Flight::request()->data->getData()));
});


?>
