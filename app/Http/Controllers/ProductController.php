<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index()
    {
        $products = Http::get('http://sargas.test/api/products')['data'];
        return view('product.product', compact('products'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:products',
            'price' => 'required|integer'
        ]);

        Http::post('http://sargas.test/api/products', $request->all());

        Alert::success('Notifikasi', 'Data berhasil disimpan');
        return back();
    }

    public function update(Request $request, $id)
    {
        Http::patch('http://sargas.test/api/products/'.$id, $request->all());

        Alert::success('Notifikasi', 'Data berhasil diupdate');
        return back();
    }

    public function destroy($id)
    {
        Http::delete('http://sargas.test/api/products/'.$id);

        Alert::success('Notifikasi', 'Data berhasil dihapus');
        return back();
    }

    public function get_product()
    {
        $products = Product::select('id', 'name')->get();

        $response  = [
            'products' => $products
        ];

        return response()->json($response);
    }
}
