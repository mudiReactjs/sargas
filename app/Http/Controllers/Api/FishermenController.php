<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Fishermen\FishermenCollection;
use App\Http\Resources\Fishermen\FishermenResource;
use App\Models\Debt;
use App\Models\Fishermen;
use App\Models\Location;
use App\Models\Product;
use App\Models\Sack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FishermenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fishermen = Fishermen::orderBy('id', 'desc')->paginate(10);

        $json = [
            'status' => ApiFormatter::getResponse(200, 'get'),
            'data' => new FishermenCollection($fishermen)
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
        $locations = Location::select('id', 'name')->get();
        $products = Product::select('id', 'name')->get();

        $data = [
            'locations' => $locations,
            'products' => $products
        ];

        return response($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'no_tlp' => 'required|regex:/[0-9]/',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required|boolean'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            $json = [
                'status' => ApiFormatter::getResponse(400, 'error'),
                'message' => $validator->errors()
            ];
        }

        $save = Fishermen::create($request->all());

        $json = [
            'status' => ApiFormatter::getResponse(201, 'post'),
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
        $fishermen = Fishermen::find($id);
        $debt = Debt::where('fishermen_id', $id)->first();
        $sack = Sack::where('fishermen_id', $id)->first();

        if ($sack != null) {
            $getSack = [
                'sack_brought' => $sack->sack_brought,
                'sack_deposit' => $sack->sack_deposit,
                'residual' =>  $sack->residual
            ];
        } else {
            $getSack = [
                'sack_brought' => 0,
                'sack_deposit' => 0,
                'residual' =>  0
            ];
        }

        if ($debt != null) {
            if ($debt->nominal > 0) {
                $status = 'Belum Lunas';
            } else {
                $status = 'Lunas';
            }
            $getDebt = [
                'nominal' => 'Rp. '.number_format($debt->nominal,0,',','.'),
                'status' => $status
            ];
        } else {
            $getDebt = [
                'nominal' => 'RP. 0',
                'status' => 'Tidak ada kasbon'
            ];
        }

        if ($fishermen) {
            $json = [
                'status' => ApiFormatter::getResponse(200, 'get'),
                'data' => [
                    'fishermen' => new FishermenResource($fishermen),
                    'sack' => $getSack,
                    'debt' => $getDebt
                ]
            ];
        } else {
            $json = [
                'status' => ApiFormatter::getResponse(400, 'error')
            ];
        }

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
        //
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
        //
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
