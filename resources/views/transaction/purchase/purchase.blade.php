@extends('layout.general')
@section('content')
<div class="main-page" style="padding: 20px">
    <div class="row">
        <div class="col-md-12" style="margin-top: 20px;">
           <div style="padding: 15px">
                <h3 class="mb-4" style="float: left">Transaksi Produk</h3>
                <a href="{{route('tr.index')}}" style="float: right" class="btn btn-warning">Kembali</a>
           </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-7">
                <div class="inline-form widget-shadow">
                    <div class="form-body">
                        <div data-example-id="simple-form-inline" style="margin-top: 15px">
                            </form>
                            <form action="" class="form-inline mb-4" method="GET">
                                <div class="form-group form-select-transaction__product">
                                    <select name="product_id" class="form-control" id="">
                                        @foreach ($getData['products'] as $product)
                                            <option value="{{$product['id']}}">{{$product['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="float:right">
                                    <button type="submit" class="btn btn-warning">Lock</button>
                                </div>
                                <div class="form-group form-select-transaction__product" style="margin-top: 10px">
                                    <select name="location_id" class="form-control" id="">
                                        <option value="">Select Lokasi</option>
                                        @foreach ($getData['locations'] as $location)
                                            <option value="{{$location['id']}}">{{$location['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                           <div class="row">
                                @foreach ($getData['fishermen'] as $fishermen)
                                <div class="col-md-4 mb-4">
                                    <div class="card list_name_card">
                                        <div class="card-body">
                                            <img src="{{asset('uploads/fishermen/'.$fishermen['photo'])}}" alt="">
                                            <div class="text-center list_name_card_title">
                                                <h4>{{$fishermen['fishermenName']}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="inline-form widget-shadow">
                    <div class="form-title">
                        <h4>TR.Kode ......</h4>
                    </div>
                        <ul class="list_transaction_detail">
                            <li>
                                <a href="#">
                                    <div class="chat-left">
                                        <img src="{{asset('assets/images/i1.png')}}" alt="">
                                    </div>
                                    <div class="chat-right">
                                        <p>Mbah Mijan Bangsri</p>
                                        <h6>Blebak</h6>
                                    </div>
                                    <div class="clearfix"> </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="chat-left">
                                        <img src="{{asset('assets/images/i1.png')}}" alt="">
                                    </div>
                                    <div class="chat-right">
                                        <p>Mbah Mijan Bangsri</p>
                                        <h6>Blebak</h6>
                                    </div>
                                    <div class="clearfix"> </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="chat-left">
                                        <img src="{{asset('assets/images/i1.png')}}" alt="">
                                    </div>
                                    <div class="chat-right">
                                        <p>Mbah Mijan Bangsri</p>
                                        <h6>Blebak</h6>
                                    </div>
                                    <div class="clearfix"> </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="chat-left">
                                        <img src="{{asset('assets/images/i1.png')}}" alt="">
                                    </div>
                                    <div class="chat-right">
                                        <p>Mbah Mijan Bangsri</p>
                                        <h6>Blebak</h6>
                                    </div>
                                    <div class="clearfix"> </div>
                                </a>
                            </li>
                            <li>
                                <hr>
                            </li>
                            <li>
                                <form class="form-inline mb-4" >
                                    <div class="form-group" style="margin-bottom: 10px">
                                        <label for="">Total Quantity</label>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px">
                                        <input type="search" class="form-control" id="exampleInputPassword3" placeholder="search">
                                    </div>

                                    <div class="form-group" style="margin-right: 18.5px">
                                        <label for="">Harga Produk</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="search" class="form-control" id="exampleInputPassword3" placeholder="search">
                                    </div>
                                </form>
                            </li>
                            <li>
                                <hr>
                            </li>
                            <li>
                                <form class="form-inline mb-4" >
                                    <div class="form-group" style="margin-right: 53px">
                                        <label for="">Sub Total</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="exampleInputPassword3" placeholder="search">
                                    </div>
                                </form>
                            </li>
                            <li>
                                <hr>
                            </li>
                            <li>
                                <form class="form-inline mb-5" >
                                    <div class="form-group" style="margin-right: 53px">
                                        <label for="">Sub Total</label>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 20px">
                                        <select name="" class="form-control" id="">
                                            <option value="">Transfer</option>
                                            <option value="">Cash</option>
                                        </select>
                                    </div>
                                    <div style="float: right">
                                        <button class="btn btn-primary">Bayar</button>
                                        <button class="btn btn-danger">Cancel</button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
