<?php

/**
*  @OA\Post(path="/register", tags={"login"},
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
Flight::route('POST /register', function(){
  $data = Flight::request()->data->getData();
  Flight::userService()->register($data);
  Flight::json(["message" => "Confirmation email has been sent. Please confirm your account."]);
});

/**
 * @OA\Get(path="/confirm/{token}", tags={"login"},
 *     @OA\Parameter(type="string", in="path", name="token", default=123, description="Temporary token for activating account"),
 *     @OA\Response(response="200", description="Message upon successfull activation.")
 * )
 */
Flight::route('GET /confirm/@token', function($token){
  Flight::json(Flight::jwt(Flight::userService()->confirm($token)));
});

/**
*  @OA\Post(path="/login", tags={"login"},
*   @OA\RequestBody(description="Basic user info", required=true,
*     @OA\MediaType(mediaType="application/json",
*    		@OA\Schema(
*         @OA\Property(property="email", requierd=true, type="string", example="firstlastName@gmail.com", description="Email of the user"),
*         @OA\Property(property="password", requierd=true, type="string", example="MyPassword", description="Password of the user"),
*         )
*     )
*      ),
 *  @OA\Response(response="200", description="User logging into account")
 * )
 */
Flight::route('POST /login', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::userService()->login($data));
});

/**
 * @OA\Post(path="/forgot", tags={"login"}, description="Send recovery URL to users email address",
 *   @OA\RequestBody(description="Basic user info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="email", required="true", type="string", example="myemail@gmail.com",	description="User's email address" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Message that recovery link has been sent.")
 * )
 */
Flight::route('POST /forgot', function(){
  $data = Flight::request()->data->getData();
  Flight::userService()->forgot($data);
  Flight::json(["message" => "Recovery link has been sent to your email"]);
});


/**
 * @OA\Post(path="/reset", tags={"login"}, description="Reset users password using recovery token",
 *   @OA\RequestBody(description="Basic user info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="token", required="true", type="string", example="123",	description="Recovery token" ),
 *    				 @OA\Property(property="password", required="true", type="string", example="123",	description="New password" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Message that user has changed password.")
 * )
 */
Flight::route('POST /reset', function(){
  Flight::json(Flight::jwt(Flight::userService()->reset(Flight::request()->data->getData())));
});
?>
