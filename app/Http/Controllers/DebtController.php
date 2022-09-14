<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Fishermen;
use App\Models\ProofDebt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class DebtController extends Controller
{
    public function index()
    {
        $debts= Debt::select('id', 'fishermen_id', 'code', 'nominal')->orderBy('id', 'desc')->paginate(10);
        return view('debt.list', compact('debts'));
    }

    public function form($fishermen_id)
    {
        $code = Carbon::now()->format('M/d/Y/H:i:s');

        $check = Debt::where('fishermen_id', $fishermen_id)->first();
        $fishermen = Fishermen::where('fishermens.id', $fishermen_id)->first();


        if ($check != null) {
            $checkData = [
                'fishermen_id' => $fishermen->id,
                'name' => $fishermen->name,
                'nominal' => $check->nominal,
                'code' => $check->code

            ];
        } else {
            $checkData = [
                'fishermen_id' => $fishermen->id,
                'name' => $fishermen->name,
                'nominal' => 0,
                'code' => 'KB.'.$code

            ];
        }
        return view('debt._form', compact('checkData'));
    }

    public function submission(Request $request, $fishermen_id)
    {
        $debt = Debt::where('fishermen_id', $fishermen_id)->first();

        if ($debt != null) {

            $cashDependent = $request->cash_dependent;
            $nominal = $request->nominal + $cashDependent;

            $dataUpdate = [
                'code' => $request->code,
                'fishermen_id' => $request->fishermen_id,
                'cash_dependent' => $request->cash_dependent,
                'nominal' => $nominal
            ];

            $debt->update($dataUpdate);
        } else {
            $dataSave = [
                'code' => $request->code,
                'fishermen_id' => $request->fishermen_id,
                'nominal' => $request->nominal
            ];

            Debt::create($dataSave);
        }

        Alert::success('Notifikasi', 'Berhasil disimpan');
        return redirect()->route('fishermen.list');
    }

    public function payment_form($id)
    {
        $debt = Debt::where('id', $id)->first();
        return view('debt._form-payment', compact('debt'));
    }

    public function payment_update(Request $request, $id)
    {
        $debt = Debt::where('id', $id)->first();

        $updateNominal = $debt->nominal - $request->payment_nominal;
        $debt->update(['nominal' => $updateNominal]);


        $image = $request->image;
        $new_image = time().Str::slug($image->getClientOriginalName());
        $image->move('uploads/proof_debt', $new_image);


        $proofDebtData = [
            'debt_id' => $debt->id,
            'image' => $new_image
        ];

        ProofDebt::create($proofDebtData);


        Alert::success('Notifikasi', 'Data berhasil diupdate');
        return redirect()->route('debt.index');
    }
}
