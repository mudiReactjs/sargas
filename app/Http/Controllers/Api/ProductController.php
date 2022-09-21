<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        $repsonse= [
            'status' => ApiFormatter::getResponse(200, 'get'),
            'data' => new ProductCollection($products)
        ];

        return response($repsonse, 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),
        [
            'name' => 'required|unique:products',
        ]

        );

        if ($validator->fails()) {
            $json = [
                'status' => ApiFormatter::getResponse(400, 'error'),
                'message' => $validator->errors()
            ];

            return response($json, 400);
        }

        $save = Product::create($request->all());

        $json = [
            'status' => ApiFormatter::getResponse(201, 'post'),
            'data' => new ProductResource($save)
        ];

        return response($json, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        $json = [
            'status' => ApiFormatter::getResponse(200, 'get'),
            'data' => new ProductResource($product)
        ];

        return response($json, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->update($request->all());

        $json = [
            'status' => ApiFormatter::getResponse(201, 'patch'),
        ];

        return response($json, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        $json = [
            'message' => ApiFormatter::getResponse(200, 'delete')
        ];

        return response($json, 200);
    }
}
