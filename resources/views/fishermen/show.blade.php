@extends('layout.general')
@section('content')

<div class="main-page" style="padding-top: 30px;">

    <div class="row">
        <div class="col-md-12 mb-4">
            <h3 class="mb-4" style="float: left">Detail Nelayan</h3>
            <a class="btn btn-warning" href="{{route('fishermen.list')}}" style="float: right">Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mb-4 validation-grids widget-shadow" data-example-id="basic-forms">
                    <div class="form-title">
                        <h3>Info Dasar</h3>
                    </div>
                    <div class="form-body">
                        <form data-toggle="validator">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" id="inputName" disabled value="{{$fishermen['name']}}">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" id="inputName" disabled value="{{$fishermen['address']}}">
                            </div>
                            <div class="form-group">
                                <label>No Telepon</label>
                                <input type="text" class="form-control" id="inputName" disabled value="{{$fishermen['no_tlp']}}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 mb-4 validation-grids validation-grids-right">
                    <div class="widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h3>Info Khusus</h3>
                        </div>
                        <div class="form-body">
                            <form data-toggle="validator">
                                <div class="form-group">
                                    <label>Produk</label>
                                    <input type="text" class="form-control" disabled value="{{$fishermen['product']['name']}}">
                                </div>
                                <div class="form-group">
                                    <label>Lokasi / Origin</label>
                                    <input type="text" class="form-control" disabled value="{{$fishermen['location']['name']}}">
                                </div>
                                <div class="form-group">
                                    <label>Alat Pengambilan</label>
                                    <input type="text" class="form-control" id="inputName" disabled value="{{$fishermen['tool']}}">
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Keluarga</label>
                                    <input type="number" min="1" class="form-control" id="inputName" disabled value="{{$fishermen['family_amount']}}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- <div class="clearfix"> </div>
                <div class="col-md-6 validation-grids widget-shadow" data-example-id="basic-forms">
                    <div class="form-title">
                        <h3>Karung</h3>
                    </div>
                    <div class="form-body">
                        <form data-toggle="validator">
                            <div class="form-group">
                                <label>Karung Diminta</label>
                                <input type="text" class="form-control" id="inputName"  disabled value="{{$getDetail['sack']['countSack']}}">
                            </div>
                            <div class="form-group">
                                <label>Jumlah karung dibawa</label>
                                <input type="text" class="form-control" id="inputName" disabled value="{{$getDetail['sack']['sackBrought']}}">
                            </div>
                            <div class="form-group">
                                <label>Jumlah karung disetorkan</label>
                                <input type="text" class="form-control" id="inputName" disabled value="{{$getDetail['sack']['sackDeposit']}}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 validation-grids validation-grids-right">
                    <div class="widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h3>Kasbon</h3>
                        </div>
                        <div class="form-body">
                            <form data-toggle="validator">
                                <div class="form-group">
                                    <label>Kode</label>
                                    <input type="text" class="form-control" id="inputName" disabled value="{{$getDetail['cash_receipt']['code']}}">
                                </div>
                                <div class="form-group">
                                    <label>Total Kasbon</label>
                                    <input type="text" class="form-control" id="inputName" disabled value="{{$getDetail['cash_receipt']['nominal']}}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div> --}}
            </div>
        </div>

    </div>
</div>
@endsection
