@extends('layout.general')
@section('content')
<div class="main-page" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4" style="float: left">Transaksi Pending</h3>
            <a class="btn btn-warning" href="{{route('tr.index')}}" style="float: right">Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="tables">
                <div class="bs-example widget-shadow" data-example-id="bordered-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode transaksi</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchasePending as $result)
                            <tr>
                                <td>{{$result->code_tr}}</td>
                                <td>{{$result->product->name}}</td>
                                <td>{{$result->qty}}</td>
                                <td>Rp. {{number_format($key->total,0,',','.')}}</td>
                                <td>{{$result->payment_method}}</td>
                                <td>
                                    @if ($result->status == 0)
                                        <span class="badge bg-danger">Pending</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#gridSystemModal">Upload Receipt</a>
                                </td>
                                <div class="modal fade" id="gridSystemModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="gridSystemModalLabel">Receipt Kode {{$result->code_tr}}</h4>
                                            </div>
                                            <form action="{{route('purchase.upload-receipt', $result->id)}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="" class="mb-3">Upload receipt</label>
                                                        <input type="file" name="receipt" class="form-control">
                                                    </div>
                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                    </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span class="text-center">
                        {{$purchasePending->links()}}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
