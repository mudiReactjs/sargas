@extends('layout.general')
@section('content')
<div class="main-page" style="padding-top: 30px;">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4" style="float: left">Data karung</h3>
            <a class="btn btn-warning" href="{{route('fishermen.index')}}" style="float: right">Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="tables">
                <div class="bs-example widget-shadow" data-example-id="bordered-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Nelayan</th>
                                <th>Karung dibawa</th>
                                <th>Karung disetorkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sacks as $value => $result)
                            <tr>
                                <th scope="row">{{$value + $sacks->firstitem()}}</th>
                                <td>{{$result->fishermen->name}}</td>
                                <td>{{$result->sack_brought}}</td>
                                <td>{{$result->sack_deposit}}</td>
                                <td class="text-center">
                                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-{{$result->id}}">Pengembalian Karung</a>
                                </td>
                            </tr>
                            <div class="modal fade" id="edit-{{$result->id}}" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="gridSystemModalLabel">Pengembalian karung</h4>
                                        </div>
                                        <form action="{{route('sack.update', $result->id)}}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="" class="mb-3">Jumlah yang disetorkan</label>
                                                    <input type="number" min="1" name="sack_deposit" class="form-control" placeholder="Jumlah yang disetorkan">
                                                </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Setorkan</button>
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

@endsection
