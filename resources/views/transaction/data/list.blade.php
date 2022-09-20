@extends('layout.general')
@section('content')
<div class="main-page" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4" style="float: left">Data Transaksi</h3>
            <a class="btn btn-warning" href="{{route('tr.index')}}" style="float: right">Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="tables">
                <div class="bs-example widget-shadow" data-example-id="bordered-table">
                    <h4>Periode : {{$getPeriode}} Bulan {{date('M/Y')}}</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode transaksi</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Method</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $result=> $key)
                            <tr>
                                <td>{{$key->code_tr}}</td>
                                <td>{{$key->tot_qty}}</td>
                                <td>Rp. {{number_format($key->tot_payment,0,',','.')}}</td>
                                <td>{{$key->payment_method}}</td>
                                <td>
                                    @if ($key->status == 1)
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-danger">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span class="text-center">
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="tables">
                <div class="bs-example widget-shadow" data-example-id="bordered-table">
                    <h4>Info Lain</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Method</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $result=> $key)
                            <tr>
                                <td>Sargassum</td>
                                <td>{{$key->tot_qty}}</td>
                                <td>Rp. {{number_format($key->tot_payment,0,',','.')}}</td>
                                <td>{{$key->payment_method}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span class="text-center">
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
