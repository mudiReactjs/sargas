<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Debt;
use App\Models\Fishermen;
use App\Models\ProofDebt;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DebtController extends Controller
{
    public function form()
    {
       

    }

    // public function create($fishermen_id)
    // {
    //     $code = Carbon::now()->format('M/d/Y/H:i:s');

    //     $check = Debt::select('nominal','code')
    //                     ->where('fishermen_id', $fishermen_id)
    //                     ->first();
    //     $fishermen = Fishermen::where('id', $fishermen_id)->select('name')->first();


    //     if ($check != null) {
    //         $checkData = [
    //             'fishermen_id' => $fishermen_id,
    //             'name' => $fishermen->name,
    //             'nominal' => $check->nominal,
    //             'code' => $check->code

    //         ];
    //     } else {
    //         $checkData = [
    //             'fishermen_id' => $fishermen_id,
    //             'name' => $fishermen->name,
    //             'nominal' => 0,
    //             'code' => 'KB.'.$code
    //         ];
    //     }

    //     $json = [
    //         'status' => ApiFormatter::getResponse(200, 'get'),
    //         'data' => $checkData
    //     ];

    //     return response($json, 200);
    // }

    // public function store(Request $request, $fishermen_id)
    // {
    //     $debt = Debt::where('fishermen_id', $fishermen_id)->first();

    //     if ($debt != null) {

    //         $cashDependent = $request->cash_dependent;
    //         $nominal = $request->nominal + $cashDependent;

    //         $dataUpdate = [
    //             'code' => $request->code,
    //             'fishermen_id' => $fishermen_id,
    //             'cash_dependent' => $request->cash_dependent,
    //             'nominal' => $nominal
    //         ];
    //         $debt->update($dataUpdate);
    //     } else {
    //         $dataSave = [
    //             'code' => $request->code,
    //             'fishermen_id' => $fishermen_id,
    //             'nominal' => $request->nominal
    //         ];

    //         Debt::create($dataSave);
    //     }

    //     $json = [
    //         'status' => ApiFormatter::getResponse(201, 'post')
    //     ];

    //     return response($json, 201);
    // }

    // public function payment($id)
    // {
    //     $debt = Debt::join('fishermens', 'debts.fishermen_id', '=', 'fishermens.id')
    //                 ->select('debts.id', 'debts.code', 'debts.nominal', 'fishermens.name as fishermenName')
    //                 ->where('debts.id', $id)
    //                 ->first();

    //     $json = [
    //         'message' => 'Data successfully retrieve',
    //         'data' => $debt
    //     ];

    //     return response($json, 201);
    // }

    // public function payment_update(Request $request, $id)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'image' => 'required|mimes:png,jpg,jpeg'
    //     ]);

    //     if($validator->fails()) {
    //         $json = [
    //             'status' => ApiFormatter::getResponse(400, 'error'),
    //             'message' => $validator->errors()
    //         ];

    //         return response($json, 400);
    //     }

    //      // Input Bukti Pembayaran
    //     $proofDebt = [
    //         'debt_id' => $id,
    //         'image' => $request->image
    //     ];

    //     ProofDebt::create($proofDebt);

    //     // Update Nominal Kasbon
    //     $debt = Debt::where('id', $id)->first();
    //     $updateNominal = $debt->nominal - $request->payment_nominal;
    //     $debt->update(['nominal' => $updateNominal]);


    //     $json = [
    //         'status' => ApiFormatter::getResponse(201, 'patch')
    //     ];

    //     return response($json, 201);
    // }

}
