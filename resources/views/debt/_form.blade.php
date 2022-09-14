@extends('layout.general')
@section('content')
<div class="main-page" style="padding: 30px">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4" style="float: left">Pengajuan Kasbon</h3>
            <a class="btn btn-warning" href="{{route('fishermen.list')}}" style="float: right">Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="form-three widget-shadow">
                <form class="form-horizontal" method="POST" action="{{route('debt.submission', $checkData['fishermen_id'])}}">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Kasbon</label>
                        <div class="col-sm-9">
                            <input type="text" hidden name="code" value="{{$checkData['code']}}">
                            <input disabled  type="text" class="form-control1" value="{{$checkData['code']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" hidden name="fishermen_id" value="{{$checkData['fishermen_id']}}">
                        <label  class="col-sm-3 control-label">Nama Nelayan</label>
                        <div class="col-sm-9">
                            <input disabled type="text" class="form-control1" value="{{$checkData['name']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" hidden name="cash_dependent" value="{{$checkData['nominal']}}">
                        <label  class="col-sm-3 control-label">Info Tanggungan (Rp.)</label>
                        <div class="col-sm-9">
                            <input disabled type="number" name="cash_dependent" class="form-control1" value="{{$checkData['nominal']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Nominal Kasbon (Rp.)</label>
                        <div class="col-sm-9">
                            <input type="number" name="nominal" class="form-control1" placeholder="Nominal Kasbon">
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 25px">
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit" style="float: right">Ajukan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
