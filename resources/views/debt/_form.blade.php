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
                <h3 class="mb-4" style="float: left">Kasbon</h3>
                <a href="{{route('fishermen.index')}}" style="float: right" class="btn btn-warning">Kembali</a>
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
                                    <select name="product_id" class="form-control" id="selectMethod">
                                        <option value="">Metode Kasbon</option>
                                        <option value="pengajuan">Pengajuan</option>
                                        <option value="pembayaran">Pembayaran</option>
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
                        <h4>Silahkan Pilih Metode Kasbon</h4>
                    </div>
                    <div class="form-body">
                        <form enctype="multipart/form-data" method="POST" id="formDebt">
                            @csrf
                            <div class="form-horizontal">

                                <div id="putFishermen">

                                </div>
                                <div id="infoTanggungan">

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
        getLocation();
        getFishermen();
    });

    // Get Data Lokasi
    function getLocation()
    {
        $.ajax({
            url: "{{route('location.get')}}",
            type: 'get',
            dataType: 'json',
            success: function(response) {
                $.each(response.locations, function(key, value) {
                    $('#selectLocation').append(
                        "<option value='"+value.id+"'>"+value.name+"</option>"
                    );
                });
            }
        });
    }

    // Select Metode Kasbon (Pengajuan / Pembayaran)
    const selectMethod = document.getElementById('selectMethod');
    selectMethod.addEventListener('change', function handleChange(event) {

        if (event.target.value == 'pengajuan') {
            $('#formTitle').html(
                "<h4>Pengajuan Kasbon</h4>"
            );

            $('#formInput').html(
                "<div class='form-group'>"+
                    "<div class='col-md-12'>"+
                        "<label>Nominal Kasbon</label>"+
                        "<input type='text' class='form-control' id='submissionNominal' name='submissionNominal' placeholder='Nominal Kasbon' required>"+
                    "</div>"+
                "</div>"+
                "<div class='form-group'>"+
                    "<div class='col-md-12'>"+
                        "<button type='button' onclick='getSubmission()' class='btn btn-primary' style='float:right'>Ajukan Kasbon</button>"+
                    "</div>"+
                "</div>"
            );
            const rupiah = document.getElementById("submissionNominal");
            rupiah.addEventListener("keyup", function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah.value = formatRupiah(this.value, "Rp. ");
            });
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

        } else if(event.target.value == 'pembayaran') {
            $('#formTitle').html(
                "<h4>Pembayaran Kasbon</h4>"
            );
            // Get Data Kasbon
            $('#formInput').html(
                "<div class='form-group'>"+
                    "<div class='col-md-12'>"+
                        "<label>Nominal bayar</label>"+
                        "<input type='text' class='form-control' id='payNominal' name='payNominal' placeholder='Nominal bayar' min='1' required>"+
                    "</div>"+
                "</div>"+
                "<div class='form-group'>"+
                    "<div class='col-md-12'>"+
                        "<label>Bukti Pembayaran</label>"+
                        "<input type='file' class='form-control' id='payImage' name='image' required>"+
                        "<div id='errorImage'></div>"+
                    "</div>"+
                "</div>"+
                "<div class='form-group'>"+
                    "<div class='col-md-12'>"+
                        "<input type='submit' class='btn btn-success' style='float:right' value='Bayar'>"+
                    "</div>"+
                "</div>"
            );

            const payNominal = document.getElementById("payNominal");
            payNominal.addEventListener("keyup", function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                payNominal.value = formatRupiah(this.value, "Rp. ");
            });
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
        } else {
            $('#formTitle').html(
                "<h4>Silahkan Pilih Metode Kasbon</h4>"
            );

            $('#formInput').html("");
            $('#putFishermen').html("");
            $('#infoTanggungan').html("");
        }

    });

    // Get filter nelayan berdasarkan lokasi
    function getFishermen()
    {
        $('#selectLocation').on('change', function() {

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
                                            <img onclick='methodDebt("+fishermen[i]['id']+")' src='{{asset('uploads/fishermen')}}/"+fishermen[i]['image']+"'>\
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

    // Select Nelayan berdasarkan metode kasbon
    function methodDebt(id)
    {
        if (selectMethod.value == "") {
            alert('Silahkan pilih metode kasbon');
        } else {
            $.ajax({
                url: "{{route('debt.put-fishermen')}}",
                type: 'get',
                data: {id:id},
                success: function(response) {
                    var fishermen = response.fishermen;
                    var checkDebt  = response.checkDebt;

                    $('#infoTanggungan').html(
                        "<div class='form-group'>"+
                            "<div class='col-md-12'>"+
                                "<label>Info Tanggungan</label>"+
                                "<input type='text' class='form-control' id='debtGet' value='"+checkDebt['nominal']+"' placeholder='Info Tanggungan' min='1' disabled>"+
                            "</div>"+
                        "</div>"
                    );
                    $('#putFishermen').html(
                        "<div class='form-group'>"+
                            "<div class='col-md-12'>"+
                                "<label>Nama Nelayan</label>"+
                                "<input type='number' id='fishermenID' hidden name='fishermen_id' value='"+fishermen['id']+"'>"+
                                "<input type='text' class='form-control' value='"+fishermen['name']+"' disabled>"+
                            "</div>"+
                        "</div>"
                    );
                }
            });
        }
    }

    // Pengajuan
    function getSubmission()
    {
        if (document.getElementById('fishermenID') == null) {
            alert('Silahkan pilih nelayan');
        } else {
            var fishermenID = document.getElementById('fishermenID').value;
            var nominal = $('#submissionNominal').val();

            if (nominal == "") {
                alert('Nominal is required');
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('debt.store')}}",
                    type: 'post',
                    data: {fishermenID:fishermenID, nominal:nominal},
                    success: function(response)
                    {
                        $('#alertSuccess').html(
                            "<div class='alert alert-success alert-dismissible' role='alert'>"+
                                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>"+
                                    "<span aria-hidden='true'>&times;</span>"+
                                "</button>"+
                                "<strong>Notifikasi!</strong> "+response['message']+""+
                            " </div>"
                        );
                        document.getElementById('submissionNominal').value = "";
                        document.getElementById('debtGet').value = response['nominal'];

                    }
                })
            }

        }

    }

    // Pembayaran
    $('#formDebt').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{route('debt.payment')}}",
            method: 'post',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response)
            {
                var message = response.message;
                var status = response.status;

                if (status == 400) {
                    $('#errorImage').html(
                        "<span class='invalid-feedback text-danger' role='alert' style='font-size: 10pt'>"+
                            "<strong>"+message['image']+"</strong>"+
                        "</span>"
                    );
                } else {

                    $('#alertSuccess').html(
                        "<div class='alert alert-success alert-dismissible' role='alert'>"+
                            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>"+
                                "<span aria-hidden='true'>&times;</span>"+
                            "</button>"+
                            "<strong>Notifikasi!</strong> "+message+""+
                        " </div>"
                    );
                    document.getElementById('payNominal').value = "";
                    document.getElementById('payImage').value = "";

                    document.getElementById('debtGet').value = response.nominal;

                }



            }


        });
    })

</script>

<script>

</script>
@endsection
