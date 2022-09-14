@extends('layout.general')
@section('content')
<div class="main-page" style="padding: 30px">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4" style="float: left">Minta Karung</h3>
            <a class="btn btn-warning" href="{{route('fishermen.index')}}" style="float: right">Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="form-three widget-shadow">
                <form class="form-horizontal" action="{{route('sack.store', $check['fishermen_id'])}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="disabledinput" class="col-sm-3 control-label">Nama Nelayan</label>
                        <div class="col-sm-9">
                            <input disabled="" type="text" class="form-control1" id="disabledinput" value="{{$check['fishermenName']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" hidden name="sack_brought" value="{{$check['sack_brought']}}">
                        <label  class="col-sm-3 control-label">Karung dibawa</label>
                        <div class="col-sm-9">
                            <input disabled type="number" class="form-control1" id="disabledinput" value="{{$check['sack_brought']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Karung disetorkan</label>
                        <div class="col-sm-9">
                            <input disabled id="disabledinput" type="number" class="form-control1" value="{{$check['sack_deposit']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Karung diminta</label>
                        <div class="col-sm-9">
                            <input type="number" name="count_sack" class="form-control1" placeholder="Karung diminta">
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 25px">
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit" style="float: right">Minta</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
