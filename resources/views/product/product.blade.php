@extends('layout.general')
@section('content')
<div class="main-page" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4" style="float: left">Master Produk</h3>
            <a class="btn btn-warning" href="{{route('fishermen.index')}}" style="float: right">Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="tables">
                <div class="bs-example widget-shadow" data-example-id="bordered-table">
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger fade in">
                            <a href="#" class="close text-dark" data-dismiss="alert">&times;</a>
                            <strong>Error!</strong> {{$error}}.
                        </div>
                        @endforeach
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="7" class="text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#gridSystemModal">Tambah Produk</button>
                                </th>
                            </tr>
                            <tr>
                                <th>Id</th>
                                <th>Nama Produk</th>
                                <th>Harga Nelayan</th>
                                <th>Harga Kelompok</th>
                                <th>Harga Supllier</th>
                                <th>Harga Jual</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products['content'] as $result)
                            <tr>
                                <th scope="row">{{$result['id']}}</th>
                                <td>{{$result['name']}}</td>
                                <td>Rp. {{number_format($result['fishermen_price'],0,',','.')}}</td>
                                <td>Rp. {{number_format($result['grup_price'],0,',','.')}}</td>
                                <td>Rp. {{number_format($result['supplier_price'],0,',','.')}}</td>
                                <td>Rp. {{number_format($result['total_price'],0,',','.')}}</td>
                                <td class="text-center">
                                    <form action="{{route('product.destroy', $result['id'])}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-{{$result['id']}}">Edit</a>
                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="edit-{{$result['id']}}" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="gridSystemModalLabel">Edit Produk</h4>
                                        </div>
                                        <form action="{{route('product.update', $result['id'])}}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="" class="mb-3">Nama Produk</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Nama Produk" value="{{$result['name']}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="mb-3">Harga Nelayan</label>
                                                    <input type="text" name="fishermen_price" id="fishermenPriceEdit-{{$result['id']}}" onkeyup="sumEdit({{$result['id']}})" value="Rp. {{number_format($result['fishermen_price'],0,',','.')}}" class="form-control" placeholder="Harga Nelayan">
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="mb-3">Harga Kelompok</label>
                                                    <input type="text" name="grup_price" id="grupPriceEdit-{{$result['id']}}" onkeyup="sumEdit({{$result['id']}})" class="form-control" value="Rp. {{number_format($result['grup_price'],0,',','.')}}" placeholder="Harga Kelompok">
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="mb-3">Harga Supplier</label>
                                                    <input type="text" name="supplier_price"  onkeyup="sumEdit({{$result['id']}})" id="supplierPriceEdit-{{$result['id']}}" class="form-control" value="Rp. {{number_format($result['supplier_price'],0,',','.')}}" placeholder="Harga Supplier">
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="mb-3">Harga Total</label>
                                                    <input type="text" id="totalPriceEdit-{{$result['id']}}" name="total_price" class="form-control" value="Rp. {{number_format($result['total_price'],0,',','.')}}" placeholder="Harga Total">
                                                </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Update</button>
                                                </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="gridSystemModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Tambah produk</h4>
            </div>
            <form action="{{route('product.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="mb-3">Nama Produk</label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Produk">
                    </div>
                    <div class="form-group">
                        <label for="" class="mb-3">Harga Nelayan</label>
                        <input type="text" name="fishermen_price" id="fishermenPrice" onkeyup="sumAdd()" class="form-control" placeholder="Harga Nelayan">
                    </div>
                    <div class="form-group">
                        <label for="" class="mb-3">Harga Kelompok</label>
                        <input type="text" name="grup_price" id="grupPrice" onkeyup="sumAdd()" class="form-control" placeholder="Harga Kelompok">
                    </div>
                    <div class="form-group">
                        <label for="" class="mb-3">Harga Supplier</label>
                        <input type="text" name="supplier_price"  onkeyup="sumAdd()" id="supplierPrice" class="form-control" placeholder="Harga Supplier">
                    </div>
                    <div class="form-group">
                        <label for="" class="mb-3">Harga Total</label>
                        <input type="text" id="totalPrice" name="total_price" class="form-control" placeholder="Harga Total">
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@endsection

@section('js')
<script>

    function sumAdd()
    {
        var fishermenPrice = document.getElementById("fishermenPrice");
        var grupPrice = document.getElementById("grupPrice");
        var supplierPrice = document.getElementById("supplierPrice");
        var totalPrice = document.getElementById("totalPrice");

        fishermenPrice.value = formatRupiah(fishermenPrice.value, "Rp. ");
        grupPrice.value = formatRupiah(grupPrice.value, "Rp. ");
        supplierPrice.value = formatRupiah(supplierPrice.value, "Rp. ");

        var getFormatFishermenPrice = parseFloat(fishermenPrice.value.replace(/[^0-9-]+/g,""));
        var getFormatGroupPrice = parseFloat(grupPrice.value.replace(/[^0-9-]+/g,""));
        var getFormatSupplierPrice = parseFloat(supplierPrice.value.replace(/[^0-9-]+/g,""));

        var totalFormatPrice = getFormatFishermenPrice+getFormatGroupPrice+getFormatSupplierPrice;

        totalPrice.value = formatRupiah(totalFormatPrice.toString(), "Rp. ");
    }

    function sumEdit(id)
    {


        var fishermenPrice = document.getElementById("fishermenPriceEdit-"+id);
        var grupPrice = document.getElementById("grupPriceEdit-"+id);
        var supplierPrice = document.getElementById("supplierPriceEdit-"+id);
        var totalPrice = document.getElementById("totalPriceEdit-"+id);

        fishermenPrice.value = formatRupiahEdit(fishermenPrice.value, "Rp. ");
        grupPrice.value = formatRupiah(grupPrice.value, "Rp. ");
        supplierPrice.value = formatRupiah(supplierPrice.value, "Rp. ");

        var getFormatFishermenPrice = parseFloat(fishermenPrice.value.replace(/[^0-9-]+/g,""));
        var getFormatGroupPrice = parseFloat(grupPrice.value.replace(/[^0-9-]+/g,""));
        var getFormatSupplierPrice = parseFloat(supplierPrice.value.replace(/[^0-9-]+/g,""));

        var totalFormatPrice = getFormatFishermenPrice+getFormatGroupPrice+getFormatSupplierPrice;

        totalPrice.value = formatRupiah(totalFormatPrice.toString(), "Rp. ");
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


</script>
@endsection
