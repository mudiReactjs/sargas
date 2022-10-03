@extends('layout.general')
@section('content')
<div class="main-page" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4" style="float: left">Master Transaksi Operasional</h3>
            <a class="btn btn-warning" href="{{route('mto.home')}}" style="float: right">Kembali</a>
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
                    <table class="table table-bordered" id='datatable'>
                        <thead>
                            <tr>
                                <th colspan="7" class="text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#gridSystemModal" id='tambah'>Tambah</button>
                                </th>
                            </tr>
                            <tr>
                                <th>Code</th>
                                <th>Nama Master</th>
                                <th>Produk</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mto['content'] as $result)
                            <tr>
                                <th scope="row">{{$result['code']}}</th>
                                <td>{{$result['name']}}</td>
                                <td>{{$result['product']['name']}}</td>
                                <td class="text-center">
                                    <form action="{{route('mto.destroy', $result['id'])}}" method="POST">
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
                                            <h4 class="modal-title" id="gridSystemModalLabel">Edit Master Transaski Operasional</h4>
                                        </div>
                                        <form action="{{route('mto.update', $result['id'])}}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="" class="mb-3">Code</label>
                                                    <input type="text" name="code" disabled class="form-control" placeholder="Nama Lokasi" value="{{$result['code']}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="mb-3">Nama Master</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Nama Lokasi" value="{{$result['name']}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="mb-3">Produk</label>
                                                    <select name="product_id" id="" class="form-control">
                                                        @foreach ($products['content'] as $product)
                                                            <option value="{{$product['id']}}"
                                                                @if ($product['id'] == $result['product_id'])
                                                                    selected
                                                                @endif
                                                            >{{$product['name']}}</option>
                                                        @endforeach
                                                    </select>
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

{{-- Modal Tambah Master --}}
<div class="modal fade" id="gridSystemModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Tambah Master Transaksi Operasional</h4>
            </div>
            <form action="{{route('mto.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="mb-3">Code</label>
                        <input type="text" name="code" id="codetambahmaster" class="form-control" placeholder="Code">
                    </div>
                    <div class="form-group">
                        <label for="" class="mb-3">Nama Master</label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Master Transaksi Operasional">
                    </div>
                    <div class="form-group">
                        <label for="" class="mb-3">Produk</label>
                        <select name="product_id" id="" class="form-control">
                            @foreach ($products['content'] as $product)
                                <option value="{{$product['id']}}">{{$product['name']}}</option>
                            @endforeach
                        </select>
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
@section('js')
<script>
    $(document).ready(function(){
        $('#tambah').on('click',function(){
            var nilai=$('#datatable tr:last th:eq(0)').html();
            var nomer=parseInt(nilai.substr(2,3))+1;
            $('#codetambahmaster').val('MT'+'0'.repeat(nilai.length-3)+nomer);
        });
    });
</script>
@endsection
