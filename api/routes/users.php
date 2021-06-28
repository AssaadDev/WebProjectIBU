<?php


/* Swagger documentation */
/**
 * @OA\Info(title="Coronavirus Assistant API", version="0.1")
 * @OA\OpenApi(
 *    @OA\Server(url="http://localhost/cv19assistant/api/", description="Development Environment" ),
 * ),
 */

/**
  * @OA\Post(path="/register", tags={ "Users"},
  *   @OA\RequestBody(description="Basic account info", required=true,
  *       @OA\MediaType(mediaType="application/json",
  *    			@OA\Schema(
  *    				 @OA\Property(property="Name", required="true", type="string", example="My Test Account",	description="Name of the account" ),
  *    				 @OA\Property(property="Email", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="DateOfBirth", required="true", type="string", example="Your date of birth",	description="Email of the account" ),
 *    				 @OA\Property(property="PhoneNumber", required="true", type="string", example="Phone number (BiH network)",	description="Email of the account" ),

 *    				 @OA\Property(property="City", required="true", type="string", example="City",	description="Email of the account" ),
 *    				 @OA\Property(property="Address", required="true", type="string", example="Address",	description="Email of the account" ),
 *    				 @OA\Property(property="Country", required="true", type="string", example="Country",	description="Email of the account" ),
 *    				 @OA\Property(property="JMBG", required="true", type="string", example="JMBG",	description="Email of the account" ),
 *    				 @OA\Property(property="MedicalInsuranceNO", required="true", type="int", example="MedicalInsuranceNO",	description="Email of the account" ),
 *    				 @OA\Property(property="Vaccine", required="true", type="string", example="Vaccine",	description="Email of the account" ),


  *          )
  *       )
  *     ),
  *  @OA\Response(response="200", description="Account that has been added into database with ID assigned.")
  * )
  */
 Flight::route('POST /register ', function(){
     $data=Flight::request()->data->getData();
     Flight::json(Flight::userService()->register($data));
 });

 /**
  * @OA\Get(
  *     path="/users/confirm",tags={"Users"},
  *        @OA\Parameter(type="string", in="query", name="token", default=123, description="Token for account activation"),
  *
  *     @OA\Response(response="200", description="Message upon successful activation")
  * )
  */

Flight::route('GET /confirm/@token', function($token){
  Flight::userService()->confirm($token);

});

/**
 * @OA\Post(path="/login", tags={"Users"}, description="Login user",
 *  @OA\RequestBody(description="Basic account info", required=true,
 *       @OA\MediaType( mediaType="application/json",
 *        @OA\Schema(
 *         @OA\Property(property="Email",type="string", required=true, example="example@gmail.com", description="email of user"),
 *         @OA\Property(property="password",type="string", required=true, example="123", description="password of user")
 *      )
 *    )
 *  ),
 *  @OA\Response(response="200", description="Login user")
 * )
 */
Flight::route('POST /login', function(){


  $data=Flight::request()->data->getData();
  Flight::json(Flight::userService()->login($data));

});

/**
 * @OA\Post(path="/forgot", tags={"Users"},description="Send recovery URL",
 *   @OA\RequestBody(description="Basic user info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="Email", required="true", type="string", example="myemail@gmail.com",	description="User's email address" ),
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Message that recovery link has been sent")
 * )
 */
Flight::route('POST /forgot', function(){
  $data=Flight::request()->data->getData();
  Flight::json(Flight::userService()->forgot($data));


});
/**
 * @OA\Post(path="/reset", tags={"Users"},description="Reset password",
 *   @OA\RequestBody(description="Basic user info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="token", required="true", type="string", example="myemail@gmail.com",	description="User's email address" ),
 *    				 @OA\Property(property="password", required="true", type="string", example="myemail@gmail.com",	description="User's email address" ),
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Password reseted")
 * )
 */
Flight::route('POST /reset', function(){
  $data=Flight::request()->data->getData();
  Flight::json(Flight::userService()->reset($data));


});

/**
  * @OA\Post(path="/registerDoctor", tags={ "Users"},
  *   @OA\RequestBody(description="Basic account info", required=true,
  *       @OA\MediaType(mediaType="application/json",
  *    			@OA\Schema(
  *    				 @OA\Property(property="Name", required="true", type="string", example="My Test Account",	description="Name of the account" ),
  *    				 @OA\Property(property="Email", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="InstitutionName", required="true", type="string", example="Any kind of email",	description="Email of the account" ),

 *    				 @OA\Property(property="PhoneNumber", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="Address", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="JMBG", required="true", type="string", example="Any kind of email",	description="Email of the account" ),
 *    				 @OA\Property(property="InstitutionPosition", required="true", type="int", example="Any kind of email",	description="Email of the account" ),

  *          )
  *       )
  *     ),
  *  @OA\Response(response="200", description="Account that has been added into database with ID assigned.")
  * )
  */
 Flight::route('POST /registerDoctor ', function(){                  
     $data=Flight::request()->data->getData();
     Flight::json(Flight::userService()->registerDoctor($data));



 });

 /**
  * @OA\Put(path="/admin/users/{id}", tags={ "Admin"}, security={{"ApiKeyAuth": {}}},
  *   @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
  *   @OA\RequestBody(description="Basic account info that is going to be updated", required=true,
  *       @OA\MediaType(mediaType="application/json",
  *    			@OA\Schema(
  *    				 @OA\Property(property="role", required="true", type="string", example="My Test Account",	description="Name of the account" ),
  *          )
  *       )
  *     ),
  *     @OA\Response(response="200", description="Update account based on id")
  * )
  */
 Flight::route('PUT /admin/users/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::userService()->update($id, $data));
 });
 /**
  * @OA\Put(path="/doctors/vaccine/{id}", tags={ "Doctors"}, security={{"ApiKeyAuth": {}}},
  *   @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
  *   @OA\RequestBody(description="Update the vaccine", required=true,
  *       @OA\MediaType(mediaType="application/json",
  *    			@OA\Schema(
  *    				 @OA\Property(property="Status", required="true", type="string", example="CONFIRMED",	description="Enter the new vaccine" ),
  *          )
  *       )
  *     ),
  *     @OA\Response(response="200", description="Update account based on id")
  * )
  */
 Flight::route('PUT /doctors/vaccine/@id', function($id){              
   $data = Flight::request()->data->getData();
   Flight::json(Flight::patientService()->update($id, $data));
 });

 /**
  * @OA\Get(path="/doctors/{id}", tags={"Doctors"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of account"),
  *     @OA\Response(response="200", description="Fetch individual account")
  * )
  */
 Flight::route('GET /doctors/@id', function($id){                  
   Flight::json(Flight::doctorService()->get_by_id($id));
 });

 /**
  * @OA\Put(path="/doctors/{id}", tags={ "Doctors"}, security={{"ApiKeyAuth": {}}},
  *   @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
  *   @OA\RequestBody(description="Update the vaccine", required=true,
  *       @OA\MediaType(mediaType="application/json",
  *    			@OA\Schema(
  *    				 @OA\Property(property="Name", required="true", type="string", example="Sputnik V/",	description="Enter the new vaccine" ),
  *    				 @OA\Property(property="InstitutionName", required="true", type="string", example="Sputnik V",	description="Enter the new vaccine" ),

  *          )
  *       )
  *     ),
  *     @OA\Response(response="200", description="Update account based on id")
  * )
  */
 Flight::route('PUT /superadmin/@id', function($id){                     
   $data = Flight::request()->data->getData();
   Flight::json(Flight::superadminService()->update($id, $data));
 });
 /**
  * @OA\Put(path="/patients/vaccine/{id}", tags={ "Patients"}, security={{"ApiKeyAuth": {}}},
  *   @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
  *   @OA\RequestBody(description="Update the vaccine", required=true,
  *       @OA\MediaType(mediaType="application/json",
  *    			@OA\Schema(
  *    				 @OA\Property(property="Vaccine", required="true", type="string", example="Sputnik V/Pfizer-BioNTech/SinoVAC/AstraZeneca-CoviShield/Johnson&Johnson/",	description="Enter the new vaccine" ),
  *    				 @OA\Property(property="Status", required="true", type="string", example="PENDING (User changed Vaccine, wait for doctor confirmation)",	description="Enter the new vaccine" ),


  *          )
  *       )
  *     ),
  *     @OA\Response(response="200", description="Update account based on id")
  * )
  */
 Flight::route('PUT /activeusers/vaccine/@id', function($id){                        
   $data = Flight::request()->data->getData();
   Flight::json(Flight::activeusersService()->update($id, $data));
 });
 /**
  * @OA\Get(path="/patients/{id}", tags={"Patients"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of account"),
  *     @OA\Response(response="200", description="Fetch individual account")
  * )
  */
 Flight::route('GET /activeusers/@id', function($id){
                                                                                          
   Flight::json(Flight::activeusersService()->get_by_id($id));
 });

 /**
  * @OA\Get(
  *     path="/admin/users",tags={"Admin"},  security={{"ApiKeyAuth":{}}},
  *        @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
  *     @OA\Parameter(type="integer", in="query", name="limit", default=25, description="Limit for pagination"),
  *     @OA\Parameter(type="string", in="query", name="search", description="Search string for accounts. Case insensitive search."),
  *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
  *     @OA\Response(response="200", description="List accounts from database")
  * )
  */
 Flight::route('GET /admin/users', function(){
   $offset = Flight::query('offset', 0);
   $limit = Flight::query('limit', 25);
   $search = Flight::query('search');
   $order = Flight::query('order', "-id");

   Flight::json(Flight::userService()->get_accounts($search, $offset, $limit, $order));
 });

 /**
  * @OA\Get(path="/doctors/{id}", tags={"Doctors"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of account"),
  *     @OA\Response(response="200", description="Fetch individual account")
  * )
  */
 Flight::route('GET /superadmin/@id', function($id){                                 

   Flight::json(Flight::superadminService()->get_by_id($id));
 });

 /**
  * @OA\Get(path="/doctors/patients/{id}", tags={"Doctors"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of account"),
  *     @OA\Response(response="200", description="Fetch individual account")
  * )
  */
 Flight::route('GET /superadmin/activeusers/@id', function($id){                            

   Flight::json(Flight::activeusersService()->get_by_id($id));
 });
