@extends('layout.general')

@section('css')
<link rel="stylesheet" href="{{asset('assets/css/profile.css')}}">
@endsection
@section('content')

<div class="main-page" style="padding-top: 50px;">

    <div class="row">
        <div class="col-md-12 mb-4">
            <h3 class="mb-4" style="float: left">Detail Nelayan</h3>
            <a class="btn btn-warning" href="{{route('fishermen.list')}}" style="float: right">Kembali</a>
        </div>

        <div class="">
            <div class="col-md-4 mb-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{asset('uploads/fishermen/'.$fishermen['fishermen']['image'])}}" alt="Admin" class="rounded-circle" width="150" height="150">
                            <div class="mt-3">
                                <h4>{{$fishermen['fishermen']['name']}}</h4>
                                <p class="text-secondary mb-1">Nelayan</p>
                                <p class="text-muted font-size-sm mb-2">{{$fishermen['fishermen']['address']}}</p> <br>
                                <button class="btn btn-primary btn-sm" style="margin-right: 5px">Print Data</button><button class="btn btn-success btn-sm">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                   <div class="px-3 py-3">
                        <table class="table ">
                            <thead>
                                <th colspan="2">Info Dasar</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-3">Nama</td>
                                    <td class="py-3">: {{$fishermen['fishermen']['name']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-3">Alamat</td>
                                    <td class="py-3">: {{$fishermen['fishermen']['address']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-3">No Telepon</td>
                                    <td class="py-3">: {{$fishermen['fishermen']['no_tlp']}}</td>
                                </tr>
                            </tbody>
                        </table>
                   </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th colspan="2">Info Khusus</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-3">Produk</td>
                                    <td class="py-3">: {{$fishermen['fishermen']['product']['name']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-3">Lokasi Pengambilan</td>
                                    <td class="py-3">: {{$fishermen['fishermen']['location']['name']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-3">Alat Pengambilan</td>
                                    <td class="py-3">: {{$fishermen['fishermen']['tool']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-3">Jumlah Keluarga</td>
                                    <td class="py-3">: {{$fishermen['fishermen']['family_amount']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-3">Status</td>
                                    <td class="py-3">:
                                        @if ($fishermen['fishermen']['status'] == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="px-3 py-3">
                         <table class="table ">
                             <thead>
                                 <th colspan="2">Kasbon</th>
                             </thead>
                             <tbody>
                                 <tr>
                                     <td class="py-3">Nominal kasbon</td>
                                     <td class="py-3">: {{$fishermen['debt']['nominal']}}</td>
                                 </tr>
                                 <tr>
                                    <td class="py-3">Status</td>
                                    <td class="py-3">:
                                        <span class="badge @if($fishermen['debt']['status'] == 'Belum Lunas') bg-danger @else bg-success @endif">
                                            {{$fishermen['debt']['status']}}
                                        </span>
                                    </td>
                                 </tr>
                             </tbody>
                         </table>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th colspan="2">karung</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-3">Karung dibawa</td>
                                    <td class="py-3">: {{$fishermen['sack']['sack_brought']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-3">Karung disetorkan</td>
                                    <td class="py-3">: {{$fishermen['sack']['sack_deposit']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-3">Sisa karung</td>
                                    <td class="py-3">: {{$fishermen['sack']['residual']}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="3">Transaksi</th>
                                </tr>
                                <tr>
                                    <th>Kode Transaksi</th>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-3">Tr.04/09/2022/12/40/9</td>
                                    <td>Sargassum</td>
                                    <td>50 Kg</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
