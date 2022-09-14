<?php

namespace App\Http\Controllers;

use App\Models\Fishermen;
use App\Models\Location;
use App\Models\Sack;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SackController extends Controller
{
    public function index()
    {
        $sacks = Sack::select('id', 'fishermen_id','sack_brought', 'sack_deposit')->orderBy('created_at', 'desc')->paginate(10);
        return view('sack.list', compact('sacks'));
    }

    public function create($fishermen_id)
    {
        $checkSack = Sack::where('fishermen_id', $fishermen_id)->first();
        $fishermen = Fishermen::where('id', $fishermen_id)->first();

        if ($checkSack != null) {
            $check = [
                'fishermen_id' => $fishermen_id,
                'fishermenName' => $checkSack->fishermen->name,
                'count_sack' => $checkSack->count_sack,
                'sack_brought' => $checkSack->sack_brought,
                'sack_deposit' => $checkSack->sack_deposit
            ];
        } else {
            $check = [
                'fishermen_id' => $fishermen_id,
                'fishermenName' => $fishermen->name,
                'count_sack' => 0,
                'sack_brought' => 0,
                'sack_deposit' => 0
            ];
        }

        return view('sack._form', compact('check'));
    }

    public function store(Request $request, $fishermen_id)
    {
        $sack = Sack::where('fishermen_id', $fishermen_id)->first();


        if ($sack != null) {

            // Jika sudah pernah minta karung
            $countSackBrought = $sack->sack_brought + $request->count_sack;

            $data = [
                'fishermen_id' =>$fishermen_id,
                'sack_brought' => $countSackBrought,
            ];

            $sack->update($data);

        } else {
            $data = [
                'fishermen_id' =>$fishermen_id,
                'sack_brought' => $request->count_sack,
                'sack_deposit' => 0
            ];

            Sack::create($data);
        }

        Alert::success('Notifikasi', 'Data berhasil disimpan');
        return back();

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
