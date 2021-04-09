<?php

/**
*  @OA\Post(path="/users/register", tags={"users"},
*   @OA\RequestBody(description="Basic user info", required=true,
*     @OA\MediaType(mediaType="application/json",
*    		@OA\Schema(
*         @OA\Property(property="account", requierd=true, type="string", example="My Test Account", description="Account of the user"),
*    		  @OA\Property(property="name", requierd=true, type="string", example="First Last name", description="Name of the user"),
*         @OA\Property(property="email", requierd=true, type="string", example="firstlastName@gmail.com", description="Email of the user"),
*         @OA\Property(property="password", requierd=true, type="string", example="MyPassword", description="Password of the user"),
*         )
*     )
*      ),
 *  @OA\Response(response="200", description="Message that user has been created.")
 * )
 */
Flight::route('POST /users/register', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::userService()->register($data));
});

Flight::route('GET /users/confirm/@token', function($token){
  Flight::userService()->confirm($token);
  Flight::json(["message"=>"Your account has been activated"]);
});

?>
