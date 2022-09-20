@extends('layout.general')
@section('content')
<div class="main-page" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4" style="float: left">Transaksi Selesai</h3>
            <a class="btn btn-warning" href="{{route('tr.index')}}" style="float: right">Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="tables">
                <div class="bs-example widget-shadow" data-example-id="bordered-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode transaksi</th>
                                <th>Total Qty</th>
                                <th>Total Pembayaran</th>
                                <th>Method</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($success as $result)
                            <tr>
                                <td>{{$result->code_tr}}</td>
                                <td>{{$result->tot_qty}}</td>
                                <td>Rp. {{number_format($result->tot_payment,0,',','.')}}</td>
                                <td>{{$result->payment_method}}</td>
                                <td>
                                    @if ($result->status == 1)
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span class="text-center">
                        {{$success->links()}}
                    </span>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection
