$(document).ready(function() {
    getLocation();
    getFishermen();
});

// Get Data Lokasi
function getLocation()
{
    $.ajax({
        url: "{{route('debt.location')}}",
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
                    "<input type='number' class='form-control' id='submissionNominal' name='submissionNominal' placeholder='Nominal Kasbon' min='1' required>"+
                "</div>"+
            "</div>"+
            "<div class='form-group'>"+
                "<div class='col-md-12'>"+
                    "<button type='button' onclick='getSubmission()' class='btn btn-primary' style='float:right'>Ajukan Kasbon</button>"+
                "</div>"+
            "</div>"
        );
    } else if(event.target.value == 'pembayaran') {
        $('#formTitle').html(
            "<h4>Pembayaran Kasbon</h4>"
        );
        // Get Data Kasbon
        $('#formInput').html(
            "<div class='form-group'>"+
                "<div class='col-md-12'>"+
                    "<label>Nominal bayar</label>"+
                    "<input type='number' class='form-control' id='payNominal' name='payNominal' placeholder='Nominal bayar' min='1' required>"+
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
        url: "{{route('debt.fishermen')}}" ,
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
                                        <img onclick='methodDebt("+fishermen[i]['id']+")' fishermenID ='"+fishermen[i]['id']+"' src='{{asset('uploads/fishermen')}}/"+fishermen[i]['image']+"'>\
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
                            "<input type='number' class='form-control' id='debtGet' value='"+checkDebt['nominal']+"' placeholder='Info Tanggungan' min='1' disabled>"+
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
        var nominal = document.getElementById('submissionNominal').value;

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
