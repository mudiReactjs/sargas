<?php

namespace App\Http\Controllers;

use App\Models\Fishermen;
use App\Models\Location;
use App\Models\Sack;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SackController extends Controller
{

    public function form()
    {
        return view('sack._form');
    }

    public function checkSackFishermen(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
        }

        $checkSack = Sack::where('fishermen_id', $data['id'])->first();
        $fishermen = Fishermen::where('id', $data['id'])->select('id', 'name')->first();

        if ($checkSack != null) {
            $getCheck = [
                'fishermen_id' => $fishermen->id,
                'name' => $fishermen->name,
                'sack_brought' => $checkSack->sack_brought,
                'sack_deposit' => $checkSack->sack_deposit,
                'residual' => $checkSack->residual
            ];
        } else {
            $getCheck = [
                'fishermen_id' => $fishermen->id,
                'name' => $fishermen->name,
                'sack_brought' => 0,
                'sack_deposit' => 0,
                'residual' => 0
            ];
        }

        return response()->json($getCheck);


    }

    public function store(Request $request)
    {

        $sack = Sack::where('fishermen_id', $request->fishermen_id)->first();


        if ($sack != null) {

            // Jika sudah pernah minta karung
            $updateSackBrought = $sack->sack_brought + $request->sack;

            $data = [
                'sack_brought' => $updateSackBrought,
            ];

            $sack->update($data);

        } else {
            $data = [
                'fishermen_id' =>$request->fishermen_id,
                'sack_brought' => $request->sack,
                'sack_deposit' => 0,
                'residual' => 0
            ];

            Sack::create($data);
        }

        $response = [
            'message' => 'Data berhasil disimpan',
            'sack_brought' => $sack->sack_brought,
            'sack_deposit' => $sack->sack_deposit,
            'residual' => $sack->residual,
        ];

        return response()->json($response);

    }

    public function update(Request $request, $id)
    {
        $sack = Sack::where('id', $id)->first();

        $sackBrought = $sack->sack_brought - $request->sack_deposit;

        $data = [
            'sack_deposit' => $request->sack_deposit,
            'sack_brought' => $sackBrought
        ];

        $sack->update($data);

        Alert::success('Notifikasi', 'Karung disetorkan');
        return back();
    }
}
