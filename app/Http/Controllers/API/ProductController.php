<?php



namespace App\Http\Controllers\API;



use Illuminate\Http\Request;

use App\Http\Controllers\API\BaseController as BaseController;

use App\Models\Product;

use Validator;

use App\Http\Resources\Product as ProductResource;



class ProductController extends BaseController

{
    /**
     * @OA\Post(
     ** path="/products",
     *   tags={"Products"},
     *   summary="Product created successfully.",
     *   operationId="create-product",
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
     *      name="stock",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="number"
     *      )
     *   ),
     *
     *
     *   @OA\Parameter(
     *      name="price",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="number"
     *      )
     *   ),
     *
     *
     *   @OA\Parameter(
     *      name="shortDesc",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Parameter(
     *      name="description",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *
     *   @OA\Response(
     *      response=200,
     *       description="Product created successfully.",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     *
     *
     * @OA\Patch(
     ** path="/products/:id",
     *   tags={"Products"},
     *   summary="Update a product",
     *   operationId="update-product",
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
     *      name="stock",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="number"
     *      )
     *   ),
     *
     *
     *   @OA\Parameter(
     *      name="price",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="number"
     *      )
     *   ),
     *
     *
     *   @OA\Parameter(
     *      name="shortDesc",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Parameter(
     *      name="description",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Product updated successfully.",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     *
     * @OA\Get(
     ** path="/products",
     *   tags={"Products"},
     *   summary="List the products",
     *   operationId="list-products",
     *
     * @OA\Response(
     *      response=200,
     *       description="Products retrieved successfully.",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     * )
     *
     *      * @OA\Get(
     ** path="/products/:id",
     *   tags={"Products"},
     *   summary="Get product by ID",
     *   operationId="get-warehouses-by-id",
     *
     * @OA\Response(
     *      response=200,
     *       description="Producte retrieved successfully",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *
     * )
     *
     *
     * @OA\Delete(
     ** path="/products/:id",
     *   tags={"Products"},
     *   summary="Delete a product",
     *   operationId="delete-warehouse",
     *
     *      * @OA\Response(
     *      response=200,
     *       description="Product deleted successfully.",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *  )
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

        $products = Product::all();



        return $this->sendResponse(($products), 'Products retrieved successfully.');

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

            'price' => 'required',

            'stock' => 'required',

            'shortDesc' => 'required',

            'description' => 'required',


        ]);





        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());

        }



        $product = Product::create($input);



        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $product = Product::with(["warehouse"])->find($id);



        if (is_null($product)) {

            return $this->sendError('Product not found.');

        }



        return $this->sendResponse($product, 'Product retrieved successfully.');

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Product $product)

    {

        $input = $request->all();



        $validator = Validator::make($input, [

            'name' => 'required',

            'price' => 'required',

            'stock' => 'required',

            'shortDesc' => 'required',

            'description' => 'required'

        ]);





        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());

        }



        $product->name = $input['name'];

        $product->price = $input['price'];

        $product->stock = $input['stock'];

        $product->shortDesc = $input['shortDesc'];

        $product->description = $input['description'];



        $product->save();



        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy(Product $product)

    {

        $product->delete();



        return $this->sendResponse([], 'Product deleted successfully.');

    }

}
