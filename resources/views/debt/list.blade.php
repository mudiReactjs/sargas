@extends('layout.general')
@section('content')
<div class="main-page" style="padding-top: 30px;">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4" style="float: left">Kasbon Nelayan</h3>
            <a class="btn btn-warning" href="{{route('fishermen.index')}}" style="float: right">Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="tables">
                <div class="bs-example widget-shadow" data-example-id="bordered-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Nelayan</th>
                                <th>Nominal Kasbon</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($debts as $value =>$key)
                            <tr>
                                <th scope="row">{{$value + $debts->firstitem()}}</th>
                                <td>{{$key->code}}</td>
                                <td>{{$key->fishermen->name}}</td>
                                <td>Rp. {{number_format($key->nominal, 0, ',', '.')}}</td>
                                <td class="text-center">
                                    <a href="{{route('debt.payment_form', $key->id)}}" class="btn btn-success btn-sm">Pembayaran</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
