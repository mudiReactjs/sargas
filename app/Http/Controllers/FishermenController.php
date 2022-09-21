<?php

namespace App\Http\Controllers;

use App\Models\Fishermen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class FishermenController extends Controller
{
    public function index()
    {
        return view('fishermen.fishermen');
    }

    public function get_fishermen(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
        }

        if (empty($data['productID'])) {
            $fishermen = Fishermen::where('location_id',$data['id'])->select('id', 'name', 'image', 'location_id')->get();
        } else {
            $fishermen = Fishermen::where(['location_id'=>$data['id'], 'product_id' => $data['productID']])->select('id', 'name', 'image', 'location_id')->get();
        }

        return response()->json(['fishermen' => $fishermen]);
    }

    public function list()
    {
        $fishermen = Http::get('http://sargas.test/api/fishermen')['data'];
        return view('fishermen.list', compact('fishermen'));
    }

    public function create()
    {
        // Get data lokasi dan produk
       $data =  Http::get('http://sargas.test/api/fishermen/create');

       return view('fishermen._form', compact('data'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'no_tlp' => 'required|regex:/[0-9]/',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ];

        $this->validate($request,$rules);

        $image = $request->image;
        $new_image = time().Str::slug($image->getClientOriginalName());
        $image->move('uploads/fishermen', $new_image);

        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'no_tlp' => $request->no_tlp,
            'location_id' => $request->location_id,
            'product_id' => $request->product_id,
            'tool' => $request->tool,
            'family_amount' => $request->family_amount,
            'image' => $new_image,
            'status' => 1
        ];

        Http::post('http://sargas.test/api/fishermen', $data);

        Alert::success('Notifikasi', 'Data berhasil disimpan');
        return back();
    }

    public function show($id)
    {
        $fishermen = Http::get('http://sargas.test/api/fishermen/'.$id)['data'];

        return view('fishermen.show', compact('fishermen'));
    }
}
