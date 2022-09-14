@extends('layout.general')
@section('content')
<div class="main-page" style="padding: 30px">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4" style="float: left">Pembayaran Kasbon</h3>
            <a class="btn btn-warning" href="{{route('debt.index')}}" style="float: right">Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="form-three widget-shadow">
                <form class="form-horizontal" action="{{route('debt.payment-update', $debt->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="disabledinput" class="col-sm-3 control-label">Kode Kasbon</label>
                        <div class="col-sm-9">
                            <input disabled="" type="text" class="form-control1" id="disabledinput" value="{{$debt->code}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Nama Nelayan</label>
                        <div class="col-sm-9">
                            <input disabled="" id="disabledinput" type="text" class="form-control1" value="{{$debt->fishermen->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Nominal Kasbon (Rp.)</label>
                        <div class="col-sm-9">
                            <input disabled="" id="disabledinput" type="number" class="form-control1" value="{{$debt->nominal}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Nominal Pembayaran (Rp.)</label>
                        <div class="col-sm-9">
                            <input required name="payment_nominal" type="number" class="form-control1" value="Nominal Pembayaran (Rp.)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Bukti Pembayaran</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control1" name="image" required>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 25px">
                        <div class="col-md-12">
                            <button class="btn btn-primary" style="float: right">Bayar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
