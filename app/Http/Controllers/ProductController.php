<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

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
        ]);

        // Format currency to integer
        $fishermenPriceFormat = Str::replace(['Rp.', '.'],'',$request->fishermen_price);
        $fishermenPriceInt = (int)$fishermenPriceFormat;

        $grupPriceFormat = Str::replace(['Rp.', '.'],'',$request->grup_price);
        $grupPriceInt = (int)$grupPriceFormat;

        $supplierPriceFormat = Str::replace(['Rp.', '.'],'',$request->supplier_price);
        $supllierPriceInt = (int)$supplierPriceFormat;

        $totalPriceFormat = Str::replace(['Rp.', '.'],'',$request->total_price);
        $totalPriceInt = (int)$totalPriceFormat;

        $data = [
            'name' => $request->name,
            'fishermen_price' => $fishermenPriceInt,
            'grup_price' => $grupPriceInt,
            'supplier_price' => $supllierPriceInt,
            'total_price' => $totalPriceInt
        ];

        Http::post('http://sargas.test/api/products', $data);

        Alert::success('Notifikasi', 'Data berhasil disimpan');
        return back();
    }

    public function update(Request $request, $id)
    {
        // Format currency to integer
        $fishermenPriceFormat = Str::replace(['Rp.', '.'],'',$request->fishermen_price);
        $fishermenPriceInt = (int)$fishermenPriceFormat;

        $grupPriceFormat = Str::replace(['Rp.', '.'],'',$request->grup_price);
        $grupPriceInt = (int)$grupPriceFormat;

        $supplierPriceFormat = Str::replace(['Rp.', '.'],'',$request->supplier_price);
        $supllierPriceInt = (int)$supplierPriceFormat;

        $totalPriceFormat = Str::replace(['Rp.', '.'],'',$request->total_price);
        $totalPriceInt = (int)$totalPriceFormat;

        $data = [
            'name' => $request->name,
            'fishermen_price' => $fishermenPriceInt,
            'grup_price' => $grupPriceInt,
            'supplier_price' => $supllierPriceInt,
            'total_price' => $totalPriceInt
        ];

        Http::patch('http://sargas.test/api/products/'.$id, $data);

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
