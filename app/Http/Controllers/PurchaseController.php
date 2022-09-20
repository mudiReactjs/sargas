<?php

namespace App\Http\Controllers;

use App\Models\Fishermen;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PurchaseController extends Controller
{

    public function list()
    {
        $transactions = Purchase::paginate(10);
        $period = Carbon::now()->format('m');

        $getPeriode = Purchase::where(DB::raw('MONTH(created_at)'), $period)->count();

        return view('transaction.data.list', compact('transactions', 'getPeriode'));
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
            'product_id' => 'required',
            ],
            [
                'fishermen_id.required' => 'Silahkan pilih nelayan',
                'product_id' => 'Silahkan isi produk'
            ]
        );

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
                'fishermen_id' => $request->fishermen_id,
                'sack' => $request->sack,
                'product_id' => $request->product_id,
                'qty' => $request->qty,
                'tot_qty' => $request->tot_qty,
                'tot_payment' => $request->total_payment,
                'payment_method' => $request->payment_method,
                'receipt' => $new_receipt,
            ];
        } else {
            $data = [
                'code_tr' => $request->code_tr,
                'fishermen_id' => $request->fishermen_id,
                'sack' => $request->sack,
                'product_id' => $request->product_id,
                'qty' => $request->qty,
                'tot_qty' => $request->tot_qty,
                'tot_payment' => $request->total_payment,
                'payment_method' => $request->payment_method,
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

    public function get_fishermen(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
        }

        $fishermen = Fishermen::where('id', $data['id'])->first();

        $getFishermen = [
            'fishermen_id' => $fishermen->id,
            'name' => $fishermen->name,
            'image' => $fishermen->image
        ];

        return response()->json($getFishermen);
    }

    public function code_product_price(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
        }
        $price = Product::where('id', $data['productID'])->first();
        $codeTR = 'TR.'.Carbon::now()->format('d/M/Y/H/i/s');

        $response = [
            'price' => $price->price,
            'priceFormat' =>'Rp. '.number_format($price->price,0,',','.') ,
            'code' => $codeTR
        ];

        return response()->json($response);
    }

    public function get_qty(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();
        }

        $getData = [];
        foreach ($data['qty'] as $value) {
           $getData[] = $value;

        }

        $totQty = array_sum($getData);

        return response()->json(['totalQty' => $totQty]);
    }
}
