@extends('layout.general')
@section('content')
<div class="main-page" style="padding: 10px">
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
                            <form action="{{route('purchase.form')}}" class="form-inline mb-4" method="GET">
                                <div class="form-group form-select-transaction__product">
                                    <select name="product_id" class="form-control" id="">
                                        @foreach ($getLocationProducts['data'] ['products'] as $product)
                                            <option value="{{$product['id']}}"
                                                @if (!empty($getLocationProducts['single']))
                                                    @if ($getLocationProducts['single']['product']['id'] == $product['id'])

                                                    selected
                                                    @endif
                                                @endif
                                            >{{$product['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="float:right">
                                    <button type="submit" class="btn btn-warning">Pilih</button>
                                </div>
                                <div class="form-group form-select-transaction__product" style="margin-top: 10px">
                                    <select required name="location_id" class="form-control" id="">
                                        <option value="">Pilih Lokasi</option>
                                        @foreach ($getLocationProducts['data']['locations'] as $location)
                                            <option value="{{$location['id']}}"
                                                @if (!empty($getLocationProducts['single']))
                                                    @if ($getLocationProducts['single']['location']['id'] == $location['id'])

                                                    selected
                                                    @endif
                                                @endif
                                            >{{$location['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                           <div class="row">
                                @foreach ($getLocationProducts['data']['fishermen'] as $fishermen)
                                <div class="col-md-4 mb-4">
                                    <div class="card list_name_card">
                                        <div class="card-body">
                                            <img src="{{asset('uploads/fishermen/'.$fishermen['image'])}}" alt="" class="getName-{{$fishermen['id']}}" name-{{$fishermen['id']}} = "{{$fishermen['name']}}" image-{{$fishermen['id']}} = '{{asset('uploads/fishermen/'.$fishermen['image'])}}'>
                                            <div class="text-center list_name_card_title">
                                                <h4>{{$fishermen['name']}}</h4>
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
                    <div class="form-title mb-3">
                        <h4>Kode Transaksi : {{$getLocationProducts['data']['code']}}</h4>
                    </div>
                    <div class="form-body">
                        <form action="{{route('purchase.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @foreach ($getLocationProducts['data']['fishermen'] as $fishermen )
                                <div class="mb-3" id="demo-{{$fishermen['id']}}" class="@error('fishermen_id') is-invalid @enderror">
                                    @error('fishermen_id')
                                    <span class="text-danger" style="font-size: 10pt">{{$message}}</span>
                                    @enderror
                                </div>
                            @endforeach
                            <div class="form-group">
                                <label>Total quantity</label>
                                <input id="getQty" oninput="myFunction()" type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" placeholder="Total quantity" required>
                                @error('qty')
                                    <span class="text-danger" style="font-size: 10pt">{{$message}}</span>
                                @enderror
                            </div>
                            @if (!empty($getLocationProducts['single']))
                            <input type="number" hidden name="product_id" value="{{$getLocationProducts['single']['product']['id']}}">
                            <input type="number" hidden name="location_id" value="{{$getLocationProducts['single']['location']['id']}}">
                            <input type="text" value="{{$getLocationProducts['data']['code']}}" name="code_tr" hidden>
                                <div class="form-group">
                                    <label>Harga produk</label>
                                    <input id="getPrice" disabled type="number" class="form-control" value="{{$getLocationProducts['single']['product']['price']}}">
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="">Harga produk</label>
                                    <input type="text" placeholder="Harap pilih produk dan lokasi" class="form-control @error('location_id') is-invalid @enderror @error('product_id') is-invalid @enderror" disabled>
                                    @error('location_id')
                                        <span class="text-danger" style="font-size: 10pt">{{$message}}</span>
                                    @enderror
                                    @error('product_id')
                                    <span class="text-danger" style="font-size: 10pt">{{$message}}</span>
                                @enderror
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Sub total</label>
                                <input hidden id="getTotal" type="number" name="total">
                                <input id="total" disabled type="number" class="form-control" placeholder="Sub total" name="total">
                            </div>
                            <div class="form-group">
                                <label>Metode</label>
                                <select required name="payment_method" class="form-control" id="">
                                    <option value="belum-bayar">Belum Bayar</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Bukti transfer (optional)</label>
                                <input type="file" class="form-control" name="receipt">
                            </div>
                            <div class="form-group" style="text-align: right">
                                <button type="submit" class="btn btn-success">Bayar</button>
                                <button class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function myFunction() {
        var getQty = document.getElementById("getQty").value;
        var getPrice = document.getElementById('getPrice').value;

        var total = getQty*getPrice;
        document.getElementById("total").value = total;
        document.getElementById('getTotal').value = total;
    }
</script>
<script>

$(document).ready(function() {

@foreach ($getLocationProducts['data']['fishermen'] as $fishermen )
    $(".getName-{{$fishermen['id']}}").click(function() {

        var name_{{$fishermen['id']}} = $(this).attr("name-{{$fishermen['id']}}");
        var image_{{$fishermen['id']}} = $(this).attr("image-{{$fishermen['id']}}");
        $("#demo-{{$fishermen['id']}}").html(
            "<div class='chat-left'><input type='hidden' name='fishermen_id[]' value='{{$fishermen['id']}}'> <img src="+image_{{$fishermen['id']}}+"> </div> <div class='chat-right'><p>"+name_{{$fishermen['id']}}+"</p></div><div class='clearfix'> </div>"
        );
    });
@endforeach

});
</script>
@endsection
