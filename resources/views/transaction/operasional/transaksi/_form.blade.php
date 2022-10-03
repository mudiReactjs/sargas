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
                <h3 class="mb-4" style="float: left">Transaksi Operasional</h3>
                <a href="{{route('mto.home')}}" style="float: right" class="btn btn-warning">Kembali</a>
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
                            </form>
                            <div class="row">
                                <div id="getMasterOperasional">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="inline-form widget-shadow">
                    <div class="form-title mb-3" id="formTitle">
                        <h4>Transaksi Operasional</h4>
                    </div>
                    <div class="form-body">
                        <form action="{{route('to.store')}}"enctype="multipart/form-data" method="POST" id="formDebt">
                            @csrf
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-12">
                                            <label>Kode Transaksi</label>
                                            <input type="hidden" name="master_transaksi_operasional_id" value="TR.23/Sep/2022/23/50/22">
                                            <input type="text"  name="nome_transaksi" value="TR.23/Sep/2022/23/50/22" class="form-control" disabled="true">
                                    </div>
                                </div>

                                <div id="putMasterOperasional">

                                 </div>
                                <div id="putMasterOperasionalDetail">

                                 </div>

                                  <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" name="price_total" class="form-control" id="jumlahbayar" placeholder="Rp">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select name="payment_method" class="form-control" id="product_id">
                                                <option value="">Metode Bayar</option>
                                                <option value="cash">cash</option>
                                                <option value="transafer">transafer</option>
                                            </select>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Bukti Pembayaran</label>
                                            <input type="file" name="bukti_bayar" class="form-control @error('bukti_bayar') is-invalid @enderror" id="inputName" required>
                                            @error('payment_method')
                                                <span class="invalid-feedback text-danger" role="alert" style="font-size: 10pt">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-10">
                                        <center>
                                            <button type="submit" style="text-justify:center" class="btn btn-danger">Bayar</button>
                                        </center>
                                    </div>
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
// array untuk menangkap nilai master
var nilaimaster=[];
$(document).ready(function() {
        getProduct();
        getSelectMaster();// untuk mencari master berdasarkan produk

    });
    // Get Product
    function getProduct()
    {
        $.ajax({
            url: "{{route('to.get-product')}}",
            type: 'get',
            dataType: 'json',
            success: function(resp)
            {
                var products = resp['content'];
                $.each(products, function(key, value) {
                    $('#selectProduct').append(
                        "<option value='"+value.id+"'>"+value.name+"</option>"
                    );
                });

            }
        });
    }
    //getSelectMaster
    function getSelectMaster(){
    $('#selectProduct').on('change',function(){
        // alert(id);
        var id=$(this).val();
        nilaimaster=[];
        $.ajax({
            url:"{{route('mto.get')}}",
            type:'get',
            success:function(response){
                if(response.length>0){
                    var html="";
                    var nomer=0;
                    for(let i=0;i<response.length;i++){
                        if(response[i].product_id==id){
                            html +="<div class='col-md-4 mb-4'>\
                                  <div class='card list_name_card'>\
                                  <img onclick='selectmasteroperasional("+ nomer +") 'style='cursor: pointer' src='http://127.0.0.1:8000/uploads/fishermen/1663943756enemipng'>\
                                 </div>\
                                <div class='text-center list_name_card_title'>\
                                  <h4>"+ response[i]['name']+"</h4>\
                                    </div>\
                                </div>"
                                nilaimaster.push(response[i]['name']);
                                nomer++;
                        }
                    }
                }else{
                   $('#getMasterOperasional').html('')
                }
                $('#getMasterOperasional').html(html);
            }
        })
    });
    }
    function selectmasteroperasional(id){
        // alert(id);
        // alert(nilaimaster);
       // return;
       $('#putMasterOperasionalDetail').append(
          "<div id='getPer-"+id+"'></div>"
       );
       $('#getPer-'+id).html(
        "<div style:'margin-left:15px'>"+
        "<div id='getPer-'"+id+">"+
          "<div class='row show-card'>"+
            "<div class='form-group'>"+
            "<div class='col-md-3 right'>"+
             "<input type='hidden' name='' value=''>"+
                    "<img src='http://127.0.0.1:8000/uploads/fishermen/1663943756enemipng'><center>"+nilaimaster[id]+
                    "<input type='hidden' name='idmaster[]' value='"+ id +"'"+
                "</center></div>"+
                        "<div class='col-md-9 left'>"+
                                "<div class='row'>"+
                                    "<div class='col-md-12'>"+
                                    "<i class='fa fa-close text-danger' style='float:right; cursor: pointer;'  id='close-"+ id +"'></i>"+
                                    "</div>"+
                                "</div>"+
                                "<div class='row'>"+
                                    "<div class='col-md-12'>"+
                                    "<input type='text' required='' name='price[]' id='getInput-"+ id +"'class='form-control nominaldetail' oninput='getQty("+ id +")' onkeyup='sumAdd("+ id +")' placeholder='Nominal'>"+
                                    "</div>"+
                                "</div>"+
                                "<div class='row'>"+
                                    "<div class='col-md-12'>"+
                                    "<input type='text' required='' name='keterangan[]' class='form-control nominaldetail' placeholder='Keterangan'>"+
                                    "</div>"+
                                "</div>"+
                           "</div>"+
                       "</div>"+
            "</div>"+
            "<div class='clearfix'>"+
            "</div>"+
        "</div>"+
        "</div>"
       );
       $('#close-'+id).on('click', function() {
         $('#getPer-'+id).html("");
         let qty=[];
         $("input[name='price[]']").each(function(){
                var getqty=parseFloat($(this).val().replace(/[^0-9-]+/g,""));
                qty.push(getqty);
            });

         let gtotal=0;
         for(let i=0;i<qty.length;i++){
             gtotal=gtotal+parseInt(qty[i]);
         }
        // alert(gtotal);
        $('#jumlahbayar').val(formatRupiah(gtotal.toString(),"Rp."));
       });
   }
   function sumAdd(id){
         var inputprice = document.getElementById("getInput-"+id);
         inputprice.value = formatRupiahEdit(inputprice.value, "Rp. ");
        // menghitung kembali
         let qty=[];

         $("input[name='price[]']").each(function(){
             var getqty=parseFloat($(this).val().replace(/[^0-9-]+/g,""));
             if(isNaN(getqty)){
               qty.push(0)
             }else{
                 qty.push(getqty);
             }
          });
        let gtotal=0;
        for(let i=0;i<qty.length;i++){
            gtotal=gtotal+parseInt(qty[i]);
        }
       $('#jumlahbayar').val(formatRupiah(gtotal.toString(),"Rp."));
   }
   /* Fungsi formatRupiah */
   function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }

    /* Fungsi formatRupiah */
    function formatRupiahEdit(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }

   function getQty(id){
     let qty=[];
     $("input[name='price[]']").each(function(){

        var getqty=parseFloat($(this).val().replace(/[^0-9-]+/g,""));
        qty.push(getqty);
     });
     let gtotal=0;
     for(let i=0;i<qty.length;i++){
        gtotal=gtotal+parseInt(qty[i]);
     }
     //digunakan untuk menformat tampilan number
    $('#jumlahbayar').val(formatRupiah(gtotal.toString(),'Rp.'));
   }

</script>
@endsection
