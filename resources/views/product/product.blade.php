@extends('layout.general')
@section('content')
<div class="main-page" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4" style="float: left">Master Produk</h3>
            <a class="btn btn-warning" href="{{route('fishermen.index')}}" style="float: right">Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="tables">
                <div class="bs-example widget-shadow" data-example-id="bordered-table">
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger fade in">
                            <a href="#" class="close text-dark" data-dismiss="alert">&times;</a>
                            <strong>Error!</strong> {{$error}}.
                        </div>
                        @endforeach
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="7" class="text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#gridSystemModal">Tambah Lokasi</button>
                                </th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products['content'] as $result)
                            <tr>
                                <th scope="row">#</th>
                                <td>{{$result['name']}}</td>
                                <td>Rp. {{number_format($result['price'],0,',','.')}}</td>
                                <td class="text-center">
                                    <form action="{{route('product.destroy', $result['id'])}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-{{$result['id']}}">Edit</a>
                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="edit-{{$result['id']}}" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="gridSystemModalLabel">Edit Produk</h4>
                                        </div>
                                        <form action="{{route('product.update', $result['id'])}}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="" class="mb-3">Nama Produk</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Nama Produk" value="{{$result['name']}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="mb-3">Harga</label>
                                                    <input type="number" name="price" class="form-control" placeholder="Harga" value="{{$result['price']}}">
                                                </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Update</button>
                                                </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="gridSystemModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Tambah Lokasi</h4>
            </div>
            <form action="{{route('product.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="mb-3">Nama Produk</label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Lokasi">
                    </div>
                    <div class="form-group">
                        <label for="" class="mb-3">Harga</label>
                        <input type="integer" name="price" class="form-control" placeholder="Harga">
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@endsection
