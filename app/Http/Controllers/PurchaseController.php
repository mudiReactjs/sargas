<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PurchaseController extends Controller
{

    public function list()
    {
        $transactions = Purchase::paginate(10);
        return view('transaction.data.list', compact('transactions'));
    }
    public function form(Request $request)
    {
        if ($request->all()) {
            $getLocationProducts = Http::get('http://sargas.test/api/transactions/purchase/form', $request->all());
        } else {
            $getLocationProducts = Http::get('http://sargas.test/api/transactions/purchase/form');
        }

        return view('transaction.purchase._form', compact('getLocationProducts'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
            'fishermen_id' => 'required',
            'qty' => 'required|integer',
            'product_id' => 'required',
            'location_id' => 'required'
            ],
            [
                'fishermen_id.required' => 'Silahkan pilih nelayan',
                'location.required' => 'Silahkan isi lokasi',
                'product_id' => 'Silahkan isi produk'
            ]
        );

        $fishermenID = [];
        foreach ($request->fishermen_id as $key) {
            $fishermenID[] = $key;
        }

        if ($request->file('receipt')) {
            $this->validate($request,
                [
                    'receipt' => 'mimes:png,jpg,jpeg'
                ]
            );
            $receipt = $request->receipt;
            $new_receipt = time().Str::slug($receipt->getClientOriginalName());
            $receipt->move('uploads/receipt', $new_receipt);

            $data = [
                'code_tr' => $request->code_tr,
                'fishermen_id' => json_encode($fishermenID),
                'product_id' => $request->product_id,
                'location_id' => $request->location_id,
                'qty' => $request->qty,
                'total' => $request->total,
                'payment_method' => $request->payment_method,
                'receipt' => $new_receipt,
                'status' => 1
            ];
        } else {
            $data = [
                'code_tr' => $request->code_tr,
                'fishermen_id' => json_encode($fishermenID),
                'product_id' => $request->product_id,
                'location_id' => $request->location_id,
                'qty' => $request->qty,
                'total' => $request->total,
                'payment_method' => $request->payment_method,
                'status' => 0
            ];
        }

        Http::post('http://sargas.test/api/transactions/purchase', $data);

        Alert::success('Notifikasi', 'Transaksi selesai');
        return back();
    }

    public function pending()
    {
        $purchasePending = Purchase::where('status', 0)->orderBy('created_at', 'desc')->paginate(10);
        return view('transaction.purchase.pending', compact('purchasePending'));
    }

    public function upload_receipt(Request $request, $id)
    {
        $upload = Purchase::where('id', $id)->first();

        $validator = Validator::make($request->all(), [
            'receipt' => 'required|mimes:png,jpg,jpeg'
        ]);

        if($validator->fails()) {
            Alert::error('Notifikasi', 'Gagal upload');
            return back();
        }

        $receipt = $request->receipt;
        $new_receipt = time().Str::slug($receipt->getClientOriginalName());
        $receipt->move('uploads/receipt', $new_receipt);

        $data = [
            'receipt' => $new_receipt,
            'status' => 1
        ];

        $upload->update($data);

        Alert::success('Notifikasi', 'Data berhasil disimpan');
        return back();
    }

    public function success()
    {
        $success = Purchase::where('status', 1)->paginate(10);
        return view('transaction.purchase.success', compact('success'));
    }
}
