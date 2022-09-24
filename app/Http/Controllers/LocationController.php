<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Http::get('http://sargas.test/api/locations')['data'];
        return view('location.location', compact('locations'));
    }

    public function get_location()
    {
        $locations = Location::select('id', 'name')->get();
        return response()->json(['locations' => $locations]);
    }

    public function store(Request $request)
    {

        $this->validate($request,
            [
                'name' => 'required|unique:locations'
            ]
        );

        $data = [
            'name' => $request->name
        ];

        Http::post('http://sargas.test/api/locations/store',$data);

        Alert::success('Notifikasi', 'Data berhasil disimpan');
        return back();

    }

    public function update(Request $request, $slug)
    {
        Http::post('http://sargas.test/api/locations/update/'.$slug, $request->all());

        Alert::success('Notifikasi', 'Data berhasil diupdate');
        return back();
    }

    public function destroy($slug)
    {
        Http::delete('http://sargas.test/api/locations/destroy/'.$slug);

        Alert::success('Notifikasi', 'Data berhasil dihapus');
        return back();
    }
}
