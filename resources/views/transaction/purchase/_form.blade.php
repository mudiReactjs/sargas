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
            var productID = $('#selectProduct').val();
            if (id != "" && productID != "") {
                $.ajax({
                url: "{{route('fishermen.get')}}" ,
                type: 'get',
                data: {id : id, productID:productID},
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
            } else {
                alert('Select produk dan lokasi');
            }
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
