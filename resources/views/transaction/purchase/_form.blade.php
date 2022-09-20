{{-- @extends('layout.general')
@section('css')
<style>
    input.fishermen-qty {
        width: 48%;
        float: left;
    }
    input.fishermen-sack {
        width: 48%;
        float: right

    }
    input.form-control {
        border-radius: 5px;
    }
    select.form-control {
        border-radius: 5px;
    }
    .show-card .right img{
        width: 100%;
        border-radius: 5px;
    }
    .show-card .left p {
        font-size: 12pt;
        font-weight: 600;
    }
    .show-card .right {
        padding: 0;
    }
    .show-card .left {
        padding: 0;
    }
</style>
@endsection
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
                                    <select required name="location_id" class="form-control" id="location">
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
                                            <img src="{{asset('uploads/fishermen/'.$fishermen['image'])}}" class="selectFishermen" fishermen-id="{{$fishermen['id']}}">
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
                                <div class="mb-3" id="fishermen-{{$fishermen['id']}}" class="@error('fishermen_id') is-invalid @enderror">
                                    @error('fishermen_id')
                                        <span class="text-danger" style="font-size: 10pt">{{$message}}</span>
                                    @enderror
                                </div>
                            @endforeach
                            <div class="form-group">
                                <label>Total quantity (Kg)</label>
                                <input type="number" hidden id="totalQty" name="tot_qty">
                                <input id="getTotQty" type="number" disabled class="form-control" name="tot_qty" placeholder="Total quantity" required>
                                @error('qty')
                                    <span class="text-danger" style="font-size: 10pt">{{$message}}</span>
                                @enderror
                            </div>
                            @if (!empty($getLocationProducts['single']))
                            <input type="number" hidden name="product_id" value="{{$getLocationProducts['single']['product']['id']}}">
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
                                <label>Total pembayaran</label>
                                <input hidden id="getTotal" type="number" name="total_payment">
                                <input id="total" disabled type="number" class="form-control" placeholder="Total pembayaran" name="total">
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
                            <div class="form-group">
                                <label>Mitra</label>
                                <input type="text" class="form-control" name="mitra" placeholder="Mitra">
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

    $(document).ready(function() {


        $(".selectFishermen").on('click',function() {

           var checkLocation = document.getElementById('location').value;
            if (checkLocation == "") {
                alert('Silahkan mengisi lokasi');
            } else {

                var id = $(this).attr("fishermen-id");

                $.ajax({
                    url: "{{route('get-fishermen')}}",
                    type: 'get',
                    data: {id : id},
                    success : function(resp) {
                        $("#fishermen-"+id).html(
                            "<div class='row show-card'>"+
                                "<div class='col-md-3 right'>"+
                                    "<input type='hidden' name='' value=''>"+
                                    "<img src='{{asset('uploads/fishermen')}}/"+resp['image']+"'>"+
                                "</div>"+
                                "<div class='col-md-9 left'>"+
                                    "<div class='row'>"+
                                        "<div class='col-md-12'>"+
                                            "<p class='mb-3'>"+resp['name']+"<i class='fa fa-close text-danger' style='float:right; cursor: pointer;' id='close-"+id+"'></i>"+"</p>"+
                                            "<input type='number' hidden name='fishermen_id[]' value='"+id+"'>"+
                                            "<input type='number' required name='qty[]' id='getInput-"+id+"' class='form-control fishermen-qty' oninput='getQty("+id+")' placeholder='Quantity'>"+
                                            "<input type='number' required name='sack[]' class='form-control fishermen-sack' placeholder='Karung'>"+
                                        "</div>"+
                                    "</div>"+
                                "</div>"+
                            "</div>"+
                            "<div class='clearfix'> </div>"

                        );

                        $('#close-'+id).click(function() {
                            $("#fishermen-"+id).html("");
                        });


                    }
                });
            }

        });
    });

    function getQty(id)
    {
        let get = document.getElementById("getInput-"+id).value;
        let qty = [];
        $("input[name='qty[]']").each(function() {
            var getqty = $(this).val();
            qty.push(getqty);
        });


        $.ajax({

            url : "{{route('get_qty')}}",
            type: 'get',
            data: {qty : qty},
            success: function(response)
            {

                var price = document.getElementById('getPrice').value;

                var getTot = document.getElementById('getTotQty').value = response['data'];

                $('#close-'+id).click(function() {
                    document.getElementById('getTotQty').value = getTot-get;
                    document.getElementById('totalQty').value = getTot-get;

                    document.getElementById('total').value = price*(getTot-get);
                    document.getElementById('getTotal').value = (getTot-get);
                });


                document.getElementById('total').value = price*getTot;
                document.getElementById('getTotal').value = price*getTot;

                document.getElementById('totalQty').value = response['data'];

            }, error: function() {
                 alert("Error");
            }



        });
    }


</script>
@endsection --}}


@extends('layout.general')
@section('css')
<style>
    input.fishermen-qty {
        width: 48%;
        float: left;
    }
    input.fishermen-sack {
        width: 48%;
        float: right

    }
    input.form-control {
        border-radius: 5px;
    }
    select.form-control {
        border-radius: 5px;
    }
    .show-card .right img{
        width: 100%;
        border-radius: 5px;
    }
    .show-card .left p {
        font-size: 12pt;
        font-weight: 600;
    }
    .show-card .right {
        padding: 0;
    }
    .show-card .left {
        padding: 0;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('content')
<div class="main-page" style="padding: 10px">
    <div class="row">
        <div class="col-md-12" style="margin-top: 20px;">
           <div style="padding: 15px">
                <h3 class="mb-4" style="float: left">Transaksi Pembelian Produk</h3>
                <a href="{{route('tr.index')}}" style="float: right" class="btn btn-warning">Kembali</a>
           </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-7">
                <div class="inline-form widget-shadow">
                    <div class="form-body">
                        <div data-example-id="simple-form-inline" style="margin-top: 15px">
                            <form action="" class=" mb-4" method="GET">
                                <div class="form-group" id="alertSuccess">

                                </div>
                                <div class="form-group">
                                    <select name="product_id" class="form-control" id="selectProduct">
                                        <option value="">Pilih Produk</option>

                                    </select>
                                </div>
                                <div class="form-group" style="margin-top: 10px">
                                    <select required name="location_id" class="form-control" id="selectLocation">
                                        <option value="">Pilih Lokasi</option>

                                    </select>
                                </div>
                            </form>
                           <div class="row">
                                <div id="getFishermen">

                                </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="inline-form widget-shadow">
                    <div class="form-title mb-3" id="formTitle">
                        <h4>Transaksi Pembelian Produk</h4>
                    </div>
                    <div class="form-body">
                        <form enctype="multipart/form-data" method="POST" id="formDebt">
                            @csrf
                            <div class="form-horizontal">
                                <div id="codeTransaction">

                                </div>

                                <div id="putFishermen">

                                </div>
                                <div id="totalQty">

                                </div>
                                <div id="productPrice">

                                </div>
                                <div id="totalPayment">

                                </div>

                                <div id="formInput">

                                </div>
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
    $(document).ready(function() {
        getProduct();
        getLocation();
        getFishermen();
    });

    // Const product and location
    const selectLocation = document.getElementById('selectLocation');
    const selectProduct  = document.getElementById('selectProduct');

    // Get Product
    function getProduct()
    {
        $.ajax({
            url: "{{route('product.get')}}",
            type: 'get',
            dataType: 'json',
            success: function(resp)
            {
                $.each(resp.products, function(key, value) {
                    $('#selectProduct').append(
                        "<option value='"+value.id+"'>"+value.name+"</option>"
                    );
                });

            }
        });
    }

    // Get Location
    function getLocation()
    {
        $.ajax({
            url: "{{route('location.get')}}",
            type: 'get',
            dataType: 'json',
            success: function(resp)
            {
                $.each(resp.locations, function(key, value) {
                    $('#selectLocation').append(
                        "<option value='"+value.id+"'>"+value.name+"</option>"
                    );
                });
            }
        });
    }

    // Get Nelayan Berdasarkan Lokasi
    function getFishermen()
    {
        $('#selectLocation').on('change', function() {

            $('#putFishermen').html("");

            var id = $(this).val();
            $.ajax({
            url: "{{route('fishermen.get')}}" ,
            type: 'get',
            data: {id : id},
            success:function(response)
                {

                    var fishermen = response.fishermen;
                    var html = "";

                    if (fishermen.length > 0) {
                        for (let i = 0; i < fishermen.length; i++) {
                            html += "<div class='col-md-4 mb-4'>\
                                        <div class='card list_name_card'>\
                                            <img onclick='selectFishermen("+fishermen[i]['id']+")' style='cursor: pointer' src='{{asset('uploads/fishermen')}}/"+fishermen[i]['image']+"'>\
                                            <div class='text-center list_name_card_title'>\
                                                <h4>"+fishermen[i]['name']+"</h4>\
                                            </div>\
                                        </div>\
                                    </div>"

                        }

                    } else {
                        html += "<div class='col-md-12'>\
                                    <div class='text-center'>\
                                        <span>Data tidak ditemukan</span>\
                                    </div>\
                                </div>"

                            $('#putFishermen').html("");
                            $('#infoTanggungan').html("");
                    }
                    $('#getFishermen').html(html);


                }
            });
        });

    }

    // Select Nelayan
    function selectFishermen(id)
    {
        if (selectProduct.value == "") {
            alert('Silahkan pilih produk');
        } else {
             $.ajax({
                url: "{{route('purchase.get-fishermen')}}",
                type: 'get',
                data: {id:id},
                success: function(resp) {

                    $('#putFishermen').append(
                        "<div id='getPer-"+resp.fishermen_id+"'></div>"
                    );

                    // Select Per Nelayan
                    $('#getPer-'+resp.fishermen_id).html(
                        "<div class='row show-card'>"+
                            "<div class='col-md-3 right'>"+
                                "<input type='hidden' name='' value=''>"+
                                "<img src='{{asset('uploads/fishermen')}}/"+resp.image+"'>"+
                            "</div>"+
                            "<div class='col-md-9 left'>"+
                                "<div class='row'>"+
                                    "<div class='col-md-12'>"+
                                        "<p class='mb-3'>"+resp.name+"<i class='fa fa-close text-danger' style='float:right; cursor: pointer;' id='close-"+resp.fishermen_id+"'></i>"+"</p>"+
                                        "<input type='number' hidden name='fishermen_id[]' value='"+resp.fishermen_id+"'>"+
                                        "<input type='number' required name='qty[]' id='getInput-"+resp.fishermen_id+"' class='form-control fishermen-qty' oninput='getQty("+resp.fishermen_id+")' placeholder='Quantity'>"+
                                        "<input type='number' required name='sack[]' class='form-control fishermen-sack' placeholder='Karung'>"+
                                    "</div>"+
                                "</div>"+
                            "</div>"+
                        "</div>"+
                        "<div class='clearfix'> </div>"
                    );

                    // Button Close
                    $('#close-'+resp.fishermen_id).on('click', function() {
                        $('#getPer-'+resp.fishermen_id).html("");
                    });

                }
            });
        }
    }

    //Get Code TR and Produck Price
   $('#selectProduct').on('change', function() {
        var productID = selectProduct.value;
        if (productID == "") {
            $('#codeTransaction').html("");
            $('#productPrice').html("");
        }

        $.ajax({
            url: "{{route('purchase.code-product-price')}}",
            type: 'get',
            data: {productID:productID},
            success: function(resp)
            {
                $('#codeTransaction').html(
                    "<div class='form-group'>"+
                        "<div class='col-md-12'>"+
                            "<label>Kode Transaksi</label>"+
                            "<input type='text' value='"+resp.code+"' class='form-control' disabled>"+
                        "</div>"+
                    "</div>"
                );

                $('#productPrice').html(
                    "<div class='form-group'>"+
                        "<div class='col-md-12'>"+
                            "<label>Harga Produk</label>"+
                            "<input type='text' id='productPrice' value='"+resp.priceFormat+"' class='form-control' disabled>"+
                        "</div>"+
                    "</div>"
                );
            }
        });
   });

   // Get total QTY
   function getQty(id)
   {
        let get = document.getElementById("getInput-"+id).value;
        let qty = [];
        $("input[name='qty[]']").each(function() {
            var getqty = $(this).val();
            qty.push(getqty);
        });

        $.ajax({

            url : "{{route('get_qty')}}",
            type: 'get',
            data: {qty : qty},
            success: function(resp)
            {
                $('#totalQty').html(
                    "<div class='form-group'>"+
                        "<div class='col-md-12'>"+
                            "<label>Total Quantity</label>"+
                            "<input type='number' id='inputTotalQty' class='form-control' disabled value='"+resp.totalQty+"'>"+
                        "</div>"+
                    "</div>"
                );

                $('#close-'+id).on('click',function() {
                      document.getElementById('inputTotalQty').value = resp.totalQty - get;
                });

                var getQty = document.getElementById('inputTotalQty').value;
                var getPrice = document.getElementById('productPrice').value;
                var totalPayment = getQty*getPrice;

                console.log(totalPayment);

                // $('#totalPayment').html(
                //     "<div class ='form-group'>"+
                //         "<div class='col-md-12'>"+
                //             "<label>Total Pembayaran</label>"+
                //             "<input type='number' class='form-control' value='"+totalPayment+"'>"+
                //         "</div>"+
                //     "</div>"
                // );
            }



        });
   }


</script>
@endsection
