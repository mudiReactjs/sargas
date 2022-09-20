<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Fishermen;
use App\Models\Location;
use App\Models\Product;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function form(Request $request)
    {
        $locations = Location::select('id', 'name')->get();
        $products = Product::select('id', 'name','price')->get();
        $codeTR = 'TR.'.Carbon::now()->format('d/M/Y/H/i/s');



        if ($request->all()) {
            // Filter
            $fishermen = Fishermen::where([
                'location_id' => $request->location_id,
                'product_id' => $request->product_id
            ])->select('id', 'name', 'image')->get();

            $count = $fishermen->count();


            $location = Location::where('id', $request->location_id)->select('id', 'name')->first();
            $product = Product::where('id', $request->product_id)->select('id', 'name','price')->first();

            $json = [
                'status' => ApiFormatter::getResponse(200, 'get'),
                'data' => [
                    'products' => $products,
                    'locations' => $locations,
                    'fishermen' =>$fishermen,
                    'code' => $codeTR,
                    'count' => $count
                ],
                'single' => [
                    'location' => [
                        'id' => $location->id,
                        'name' => $location->name
                    ],
                    'product' => [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price
                    ],
                ]
            ];
        } else {
            $fishermen = Fishermen::select('id', 'name', 'image')->get();
            $count = $fishermen->count();
            $json = [
                'status' => ApiFormatter::getResponse(200, 'get'),
                'data' => [
                    'products' => $products,
                    'locations' => $locations,
                    'fishermen' =>$fishermen,
                    'code' => $codeTR,
                    'count' => $count
                ]
            ];
        }


        return response($json, 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'fishermen_id' => 'required',
            'qty' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $json = [
                'status' => ApiFormatter::getResponse(400, 'error'),
                'message' => $validator->errors()
            ];

            return response($json, 400);
        }

        $purchase = [
            'code_tr' => $request->code_tr,
            'sack' => $request->sack,
            'product_id' => $request->product_id,
            'tot_qty' => $request->tot_qty,
            'tot_payment' => $request->total_payment,
            'payment_method' => $request->payment_method,
            'receipt' => $request->receipt,
        ];
        $purchase = Purchase::create($purchase);

        // Update Sack
        $sack = $request->sack;
        $fishermen_id = $request->fishermen_id;
        foreach ($sack as $value) {
            
        }
        $detail = [
            'purchase_id' => $purchase->id,
            'fishermen_id' => $request->fishermen_id,

        ];

        $sack = [

        ];



        $json = [
            'status' => ApiFormatter::getResponse(201, 'post')
        ];

        return response($json, 201);
    }

}
