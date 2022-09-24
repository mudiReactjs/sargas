<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Master\MasterTransaksiOperasionaCollection;
use App\Models\DetailTransaksiOperasional;
use App\Models\MasterTransaksiOperasional;
use App\Models\TransaksiOperasional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiOperasionalController extends Controller
{
    public function form()
    {
        $data = MasterTransaksiOperasional::select('id', 'code','name', 'product_id')->get();

        $json = [
            'status' => ApiFormatter::getResponse(200, 'get'),
            'data' => new MasterTransaksiOperasionaCollection($data)
        ];

        return response($json, 200);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'price' => 'integer|required|regex:/[0-9]/',
            'price_total' => 'integer|required|regex:/[0-9]/',
        ]);

        if($validator->fails()) {
            $json = [
                'status' => ApiFormatter::getResponse(400, 'error'),
                'message' => $validator->errors()
            ];
            return response($json, 400);
        }

        $saveTransasksiOperasional = [
           'master_transaksi_operasional_id' => $request->master_transaksi_operasional_id,
           'price_total' =>  $request->price_total,
           'description' => $request->description,
           'payment_method' => $request->payment_method,
           'bukti_bayar' =>  $request->bukti_bayar
        ];

        $transaksiOperasional = TransaksiOperasional::create($saveTransasksiOperasional);

        foreach ($request->price as $value) {
            $saveDetailTransaksiOperasional = [
                'transaksi_operasional_id' =>  $transaksiOperasional->id,
                'price' => $value
            ];

            DetailTransaksiOperasional::create($saveDetailTransaksiOperasional);
        }

        $json = [
            'status' => ApiFormatter::getResponse(201, 'post'),
        ];

        return response($json, 201);
    }
}
