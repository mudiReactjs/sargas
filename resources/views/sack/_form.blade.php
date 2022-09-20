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
                <h3 class="mb-4" style="float: left">Karung</h3>
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
                        <h4>Form Pengajuan Karung</h4>
                    </div>
                    <div class="form-body">
                        <form method="POST" id="formSack">
                            @csrf
                            <div class="form-horizontal">
                                <div id="putFishermen">

                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Minta karung</label>
                                        <input type="number" required id="inputSack" class="form-control" name="sack" placeholder="Minta karung">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-primary" style="float: right" value="Minta Karung">
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

    $(document).ready(function() {
        getLocation();
        getFishermen();
    });


    function getLocation()
    {
        $.ajax({
            url: "{{route('location.get')}}" ,
            type: 'get',
            dataType: 'json' ,
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

    // Get filter nelayan berdasarkan lokasi
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
                                            <img onclick='clickFishermen("+fishermen[i]['id']+")' fishermenID ='"+fishermen[i]['id']+"' src='{{asset('uploads/fishermen')}}/"+fishermen[i]['image']+"'>\
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

    // When click fishermen
    function clickFishermen(id)
    {
        $.ajax({
            url: "{{route('sack.check')}}",
            type: 'get',
            data: {id:id},
            success: function(resp)
            {
                $('#putFishermen').html(
                    "<div class='form-group'>"+
                        "<div class='col-md-12'>"+
                            "<label>Nama nelayan</label>"+
                            "<input type='number' hidden id='inputFishermenId' name='fishermen_id' value='"+resp['fishermen_id']+"'>"+
                            "<input type='text' disabled class='form-control' value='"+resp['name']+"'>"+
                        "</div>"+
                    "</div>"+
                    "<div class='form-group'>"+
                        "<div class='col-md-12'>"+
                            "<label>Karung dibawa</label>"+
                            "<input type='number' hidden id='inputSackBrought' name='sack_brought' value='"+resp['sack_brought']+"'>"+
                            "<input type='number' id='sackBrought' disabled class='form-control' value='"+resp['sack_brought']+"'>"+
                        "</div>"+
                    "</div>"+
                    "<div class='form-group'>"+
                        "<div class='col-md-12'>"+
                            "<label>Karung disetorkan</label>"+
                            "<input type='number' id='sackDeposit' class='form-control' disabled value='"+resp['sack_deposit']+"'>"+
                        "</div>"+
                    "</div>"+
                    "<div class='form-group'>"+
                        "<div class='col-md-12'>"+
                            "<label>Sisa karung</label>"+
                            "<input type='number' id='residual' class='form-control' disabled value='"+resp['residual']+"'>"+
                        "</div>"+
                    "</div>"
                );
            }
        });
    }

    // Submit minta karung
    $('#formSack').on('submit', function(e) {
        e.preventDefault();

        var fishermen_id = $('#inputFishermenId').val();
        var sack = $('#inputSack').val();
        var sack_brought = $('#inputSackBrought').val();


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('sack.store')}}",
            type: 'post',
            data: {
                fishermen_id:fishermen_id,
                sack:sack,
                sack_brought:sack_brought,
            },
            success: function(resp)
            {

                $('#alertSuccess').html(
                    "<div class='alert alert-success alert-dismissible' role='alert'>"+
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>"+
                            "<span aria-hidden='true'>&times;</span>"+
                        "</button>"+
                        "<strong>Notifikasi!</strong> "+resp.message+""+
                    " </div>"
                );

                document.getElementById('inputSack').value= "";
                document.getElementById('sackBrought').value = resp.sack_brought;
                document.getElementById('sackDeposit').value = resp.sack_deposit;
                document.getElementById('residual').value = resp.residual;

            }
        });
    })

</script>
@endsection
