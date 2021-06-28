<?php



/* Swagger documentation */
/**
 * @OA\Info(title="Coronavirus Assistant API", version="0.1")
 * @OA\OpenApi(
 *    @OA\Server(url="http://localhost/cv19assistant/api/", description="Development Environment" ),
 * ),
 * @OA\SecurityScheme(

 * securityScheme="ApiKeyAuth",
 * in="header",
 *name="Authorization",
 *type="apiKey",
 *scheme="Bearer",
 *bearerFormat="JWT",
 *),
 */

/**
 * @OA\Get(
 *     path="/admin/accounts",tags={"Admin"},  security={{"ApiKeyAuth":{}}},
 *        @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for accounts. Case insensitive search."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List accounts from database")
 * )
 */
Flight::route('GET /admin/accounts', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  Flight::json(Flight::accountService()->get_accounts($search, $offset, $limit, $order));
});

/**
 * @OA\Get(path="/admin/accounts/{id}", tags={"Admin"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of account"),
 *     @OA\Response(response="200", description="Fetch individual account")
 * )
 */
Flight::route('GET /admin/accounts/@id', function($id){
  Flight::json(Flight::accountService()->get_by_id($id));
});

/**
 * @OA\Get(path="/patients/profiles/{id}", tags={"Patients"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="path", name="accounts_id", default=1, description="Id of account"),
 *     @OA\Response(response="200", description="Fetch individual account")
 * )
 */
Flight::route('GET /activeusers/profiles/@id', function($id){     
  Flight::json(Flight::activeusersService()->get_by_accounts_id($id));
});

/**
 * @OA\Get(path="/doctors/profiles/{id}", tags={"Doctors"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="path", name="Account_ID", default=1, description="Id of account"),
 *     @OA\Response(response="200", description="Fetch individual account")
 * )
 */
Flight::route('GET /superadmin/profiles/@id', function($id){    
  Flight::json(Flight::superadminService()->get_by_AID($id));
});


/**
 * @OA\Put(path="/admin/accounts/{id}", tags={ "Admin"},  security={{"ApiKeyAuth":{}}},
 *   @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic account info that is going to be updated", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="Name", required="true", type="string", example="My Test Account",	description="Name of the account" ),
 *    				 @OA\Property(property="Nickname", required="true", type="string", example="robert.prosinecki",	description="Nickname of the account" ),
 *    				 @OA\Property(property="Email", required="true", type="string", example="hahahah@gmail.com",	description="Email of the account" ),


 *    				 @OA\Property(property="Status", type="string", example="ACTIVE",	description="Account status" )
 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Update account based on id")
 * )
 */
Flight::route('PUT /admin/accounts/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::accountService()->update($id, $data));

});

/**
 * @OA\Put(path="/doctors/patients/{id}", tags={ "Doctors"},  security={{"ApiKeyAuth":{}}},
 *   @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic account info that is going to be updated", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="Name", required="true", type="string", example="My Test Account",	description="Name of the account" ),
*             @OA\Property(property="DateOfBirth", required="true", type="string", example="hahahah@gmail.com",	description="Email of the account" ),
*             @OA\Property(property="PhoneNumber", required="true", type="string", example="hahahah@gmail.com",	description="Email of the account" ),
   *    				 @OA\Property(property="PhoneNumber", required="true", type="string", example="hahahah@gmail.com",	description="Email of the account" ),
*				 @OA\Property(property="City", required="true", type="string", example="hahahah@gmail.com",	description="Email of the account" ),
 *    				 @OA\Property(property="Address", required="true", type="string", example="hahahah@gmail.com",	description="Email of the account" ),
 *    				 @OA\Property(property="Country", required="true", type="string", example="hahahah@gmail.com",	description="Email of the account" ),
 *    				 @OA\Property(property="JMBG", required="true", type="string", example="hahahah@gmail.com",	description="Email of the account" ),
 *    				 @OA\Property(property="MedicalInsuranceNO", required="true", type="string", example="hahahah@gmail.com",	description="Email of the account" ),
 *    				 @OA\Property(property="Vaccine", required="true", type="string", example="hahahah@gmail.com",	description="Email of the account" ),
 *    				 @OA\Property(property="VaccinationPlace", required="true", type="string", example="hahahah@gmail.com",	description="Email of the account" )

 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Update account based on id")
 * )
 */
 Flight::route('PUT /superadmin/activeusers/@id', function($id){        
Flight::json(Flight::activeusersService()->update_email_template(Flight::get('user'), intval($id), Flight::request()->data->getData()));
});


/**
 * @OA\Get(
 *     path="/doctors/patients",tags={"Doctors"},  security={{"ApiKeyAuth":{}}},

 *        @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for accounts. Case insensitive search."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List accounts from database")
 * )
 */
Flight::route('GET /superadmin/activeusers', function(){       
 $account_id = Flight::get('user');
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');

  $total = Flight::activeusersService()->get_email_templates($account_id, $offset, $limit, $search, $order, TRUE);
  header('total-records: ' . $total['total']);
  Flight::json(Flight::activeusersService()->get_email_templates($account_id, $offset, $limit, $search, $order));
});

 ?>
