<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\MasterTransaksiOperasional;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterTransaksiOperasionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MasterTransaksiOperasional::select('id', 'code', 'name', 'product_id')->paginate(10);
        $json = [
            'status' => ApiFormatter::getResponse(200, 'get'),
            'data' => $data
        ];
        return response($json, 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::select('id', 'name')->get();
        $json = [
            'data' => $product
        ];

        return response($json, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:master_transaksi_operasionals,code',
            'name' => 'required|string|max:100|regex:/[a-zA-Z]/'
        ]);

        if ($validator->fails()) {
            $json = [
                'message' => $validator->errors()
            ];

            return response($json, 400);
        }

        $data = MasterTransaksiOperasional::create($request->all());

        $json = [
            'status' => ApiFormatter::getResponse(201, 'post'),
            'data' => $data
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
        $data = MasterTransaksiOperasional::join('products', 'master_transaksi_operasionals.product_id', '=', 'products.id')
                                            ->where('master_transaksi_operasionals.id', $id)
                                            ->select('master_transaksi_operasionals.*', 'products.id as productID', 'products.name as productName')
                                            ->first();

        if ($data == null) {
            $json = [
                'id' => $id,
                'message' => 'Data tidak ditemukan'
            ];
            return response($json, 400);
        }
        $json = [
            'message' => 'Data ditemukan',
            'data' => $data
        ];

        return response($json, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MasterTransaksiOperasional::join('products', 'master_transaksi_operasionals.product_id', '=', 'products.id')
                                            ->where('master_transaksi_operasionals.id', $id)
                                            ->select('master_transaksi_operasionals.*', 'products.id as productID', 'products.name as productName')
                                            ->first();

        if ($data == null) {
            $json = [
                'id' => $id,
                'message' => 'Data tidak ditemukan'
            ];
            return response($json, 400);
        }
        $json = [
            'message' => 'Data ditemukan',
            'data' => $data
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
        $data = MasterTransaksiOperasional::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'max:100|regex:/[a-zA-Z]/',
        ]);

        if ($validator->fails()) {
            $json = [
                'message' => $validator->errors()
            ];

            return response($json, 400);
        }

        $data->update($request->all());

        $json = [
            'status' => ApiFormatter::getResponse(201, 'patch'),
            'data' => $data
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
        //
    }
}
