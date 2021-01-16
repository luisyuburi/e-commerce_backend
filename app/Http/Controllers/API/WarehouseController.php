<?php



namespace App\Http\Controllers\API;



use Illuminate\Http\Request;

use App\Http\Controllers\API\BaseController as BaseController;

use App\Models\Warehouse;

use Validator;

use App\Http\Resources\Warehouse as WarehouseResource;



class WarehouseController extends BaseController


{

 /**
     * @OA\Post(
     ** path="/warehouses",
     *   tags={"Warehouse"},
     *   summary="Add a warehouse",
     *   operationId="register",
     *
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Parameter(
     *      name="location",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Warehouse created successfully.",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     *
     *
     * @OA\Patch(
     ** path="/warehouses/:id",
     *   tags={"Warehouse"},
     *   summary="Update a warehouse",
     *   operationId="update-warehouse",
     *
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Parameter(
     *      name="location",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Warehouse updated successfully.",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     *
     * @OA\Get(
     ** path="/warehouses",
     *   tags={"Warehouse"},
     *   summary="List the warehouses",
     *   operationId="list-warehouses",
     *
     * @OA\Response(
     *      response=200,
     *       description="Warehouses retrieved successfully.",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     * )
     *
     *      * @OA\Get(
     ** path="/warehouses/:id",
     *   tags={"Warehouse"},
     *   summary="Get warehouse by ID",
     *   operationId="get-warehouses-by-id",
     *
     * @OA\Response(
     *      response=200,
     *       description="Warehouse retrieved successfully",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *
     * )
     *
     *
     * @OA\Delete(
     ** path="/warehouses",
     *   tags={"Warehouse"},
     *   summary="Delete a warehouse",
     *   operationId="delete-warehouse",
     *
     *      * @OA\Response(
     *      response=200,
     *       description="Warehouses deleted successfully.",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *  )
     *
     *    @OA\Post(
     ** path="/attach",
     *   tags={"Warehouse"},
     *   summary="Attach a product with a warehouse",
     *   operationId="attach-product-with-warehouse",
     *
     *     @OA\Response(
     *      response=200,
     *       description="Products attached successfully.",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *
     *
     * )
     *
     *
     *       @OA\Post(
     ** path="/detach",
     *   tags={"Warehouse"},
     *   summary="Detach a product with a warehouse",
     *   operationId="detach-product-with-warehouse",
     *
     *     @OA\Response(
     *      response=200,
     *       description="Products detached successfully.",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *
     *
     * )
     *
     *
     *
     *
     */

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $warehouses = Warehouse::all();



        return $this->sendResponse(($warehouses), 'warehouses retrieved successfully.');

    }

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $input = $request->all();



        $validator = Validator::make($input, [

            'name' => 'required',

            'location' => 'required',


        ]);





        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());

        }



        $warehouse = Warehouse::create($input);



        return $this->sendResponse(new WarehouseResource($warehouse), 'Warehouse created successfully.');

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $warehouse = Warehouse::with(["products"])->find($id);



        if (is_null($warehouse)) {

            return $this->sendError('Warehouse not found.');

        }



        return $this->sendResponse(new WarehouseResource($warehouse), 'Warehouse retrieved successfully.');

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Warehouse $warehouse)

    {

        $input = $request->all();



        $validator = Validator::make($input, [

            'name' => 'required',

            'location' => 'required',



        ]);





        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());

        }



        $warehouse->name = $input['name'];

        $warehouse->location = $input['location'];





        $warehouse->save();



        return $this->sendResponse(new WarehouseResource($warehouse), 'Warehouse updated successfully.');

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy(Warehouse $warehouse)

    {

        $warehouse->delete();



        return $this->sendResponse([], 'Warehouse deleted successfully.');

    }

    public function attach(Request $request) {

        $input = $request->all();

        $validator = Validator::make($input, [

            'warehouseid' => 'required',

            'productid' => 'required',



        ]);

        $warehouseid = $input["warehouseid"];
        $productid = $input["productid"];


        $warehouse = Warehouse::with(["products"])->find($warehouseid);



        if (is_null($warehouse)) {

            return $this->sendError('Warehouse not found.');

        }

        $attach = $warehouse->products()->syncWithoutDetaching($productid);

        return $this->sendResponse($attach, 'Product attached to warehouse successfully.');


    }

    public function detach(Request $request) {

        $input = $request->all();

        $validator = Validator::make($input, [

            'warehouseid' => 'required',

            'productid' => 'required',



        ]);

        $warehouseid = $input["warehouseid"];
        $productid = $input["productid"];


        $warehouse = Warehouse::with(["products"])->find($warehouseid);



        if (is_null($warehouse)) {

            return $this->sendError('Warehouse not found.');

        }

        $detach = $warehouse->products()->detach($productid);

        return $this->sendResponse($detach, 'Product detached to warehouse successfully.');


    }




}
