@extends('layout.general')
@section('content')
<div class="main-page" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4" style="float: left">Data Nelayan</h3>
            <a class="btn btn-warning" href="{{route('fishermen.index')}}" style="float: right">Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="tables">
                <div class="bs-example widget-shadow" data-example-id="bordered-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>No Telepon</th>
                                <th>Lokasi Pengambilan</th>
                                {{-- <th class="text-center">Kasbon</th>
                                <th class="text-center">Karung</th> --}}
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fishermen['content'] as $result)
                            <tr>
                                <td>{{$result['name']}}</td>
                                <td>{{$result['no_tlp']}}</td>
                                <td>{{$result['location']['name']}}</td>
                                {{-- <td class="text-center">
                                    <a href="{{route('debt.form', $result['id'])}}" class="btn btn-primary btn-sm">Ajukan</a>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('sack.create', $result['id'])}}" class="btn btn-success btn-sm">Minta</a>
                                </td> --}}
                                <td class="text-center">
                                    <a href="" class="btn btn-danger btn-sm">Suspend</a>
                                    <a href="{{route('fishermen.show', $result['id'])}}" class="btn btn-success btn-sm">Detail</a>
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
    </div>
</div>

@endsection
