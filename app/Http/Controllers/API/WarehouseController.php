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

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $warehouses = Warehouse::with(["products"])->get();



        return $this->sendResponse(WarehouseResource::collection($warehouses), 'warehouses retrieved successfully.');

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

}
