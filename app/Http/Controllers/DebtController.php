<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Fishermen;
use App\Models\Location;
use App\Models\ProofDebt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class DebtController extends Controller
{
    public function form()
    {
        $locations = Location::select('id', 'name')->get();
        return view('debt._form', compact('locations'));
    }

    public function put_fishermen(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
        }
        $fishermen = Fishermen::where('id', $data['id'])->select('id', 'name', 'image')->first();
        $checkDebt = Debt::where('fishermen_id', $data['id'])->first();

        if ($checkDebt != null) {
            $debt = [
                'nominal' => 'Rp. '.number_format( $checkDebt->nominal,0,',','.')
            ];
        } else {
            $debt = [
                'nominal' => 'Rp. 0'
            ];
        }

        return response()->json(['fishermen' => $fishermen, 'checkDebt' => $debt]);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
        }
        $nominalFormat = Str::replace(['Rp.', '.'],'',$data['nominal']);
        $nominalInt = (int)$nominalFormat;

        // Check Kasbon
        $checkDebt = Debt::where('fishermen_id', $data['fishermenID'])->first();

        if ($checkDebt != null) {

            $getNominal = $checkDebt->nominal;
            $updateNominal = $nominalInt + $getNominal;

            $checkDebt->update(['nominal' => $updateNominal]);


        } else {
            $insertDebt = [
                'fishermen_id' => $data['fishermenID'],
                'nominal' => $nominalInt
            ];

            Debt::create($insertDebt);
        }

        return response()->json([
            'message' => 'Data berhasil disimpan',
            'nominal' =>'Rp. '.number_format( $checkDebt->nominal,0,',','.')
        ]);

    }

    public function debt_payment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'mimes:png,jpg,jpeg'
         ]);

         if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'status' => 400
            ]);
         }

        $nominalFormat = Str::replace(['Rp.', '.'],'',$request->payNominal);
        $nominalInt = (int)$nominalFormat;

         //Update Kasbon
         $debt = Debt::where('fishermen_id', $request->fishermen_id)->first();
         $nominalUpdate = $debt->nominal - $nominalInt;
         $debt->update(['nominal' => $nominalUpdate]);

         // Save bukti transfer
         $image = $request->file('image');
         $new_image = time().Str::slug($image->getClientOriginalName());
         $image->move('uploads/proof_debt', $new_image);

         $saveProofDebt = [
            'debt_id' => $debt->id,
            'image' => $new_image
         ];
         ProofDebt::create($saveProofDebt);

         return response()->json([
            'status' => 201,
            'message'=> 'Transaksi berhasil',
            'nominal' => 'Rp. '.number_format( $debt->nominal,0,',','.')
        ]);




    }



    // public function form($fishermen_id)
    // {
    //     $checkData = Http::get('http://sargas.test/api/debt/create/'.$fishermen_id)['data'];
    //     return view('debt._form', compact('checkData'));
    // }

    // public function submission(Request $request, $fishermen_id)
    // {

    //     Http::post('http://sargas.test/api/debt/store/'.$fishermen_id, $request->all());

    //     Alert::success('Notifikasi', 'Berhasil disimpan');
    //     return back();
    // }

    // public function payment($id)
    // {
    //     $debt = Http::get('http://sargas.test/api/debt/payment/'.$id)['data'];
    //     return view('debt._form-payment', compact('debt'));
    // }

    // public function payment_update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'payment_nonminal' => 'required|integer',
    //         'image' => 'required|mimes:png,jpg,jpeg'
    //     ]);

    //     $image = $request->image;
    //     $new_image = time().Str::slug($image->getClientOriginalName());
    //     $image->move('uploads/proof_debt', $new_image);

    //     $data = [
    //         'payment_nominal' => $request->payment_nominal,
    //         'image' => $new_image
    //     ];

    //     Http::patch('http://sargas.test/api/debt/payment/'.$id,$data);

    //     Alert::success('Notifikasi', 'Data berhasil diupdate');
    //     return back();
    // }
}
