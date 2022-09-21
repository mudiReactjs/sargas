@extends('layout.general')
@section('content')

<div class="main-page" style="padding-top: 50px;">

    <div class="row">
        <div class="col-md-12 mb-4">
            <h3 class="mb-4" style="float: left">Tambah Nelayan</h3>
            <a class="btn btn-warning" href="{{route('fishermen.index')}}" style="float: right">Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="row">
               <form action="{{route('fishermen.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="col-md-6 validation-grids widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <h3>Info Dasar</h3>
                        </div>
                        <div class="form-body">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputName" placeholder="Nama Lengkap" required>
                                    @error('name')
                                        <span class="invalid-feedback text-danger" role="alert" style="font-size: 10pt">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="inputName" placeholder="Alamat" required>
                                    @error('address')
                                        <span class="invalid-feedback text-danger" role="alert" style="font-size: 10pt">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" class="form-control @error('no_tlp') is-invalid @enderror" name="no_tlp" id="inputName" placeholder="No Telepon" required>
                                    @error('no_tlp')
                                        <span class="invalid-feedback text-danger" role="alert" style="font-size: 10pt">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="inputName" required>
                                    @error('image')
                                        <span class="invalid-feedback text-danger" role="alert" style="font-size: 10pt">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6 validation-grids validation-grids-right">
                        <div class="widget-shadow" data-example-id="basic-forms">
                            <div class="form-title">
                                <h3>Info Khusus</h3>
                            </div>
                            <div class="form-body">
                                    <div class="form-group">
                                        <label>Produk</label>
                                        <select name="product_id" id="" class="form-control">
                                            @foreach ($data['products'] as $product)
                                                <option value="{{$product['id']}}">{{$product['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Lokasi / Origin</label>
                                        <select name="location_id" id="" class="form-control">
                                            @foreach ($data['locations'] as $location)
                                                <option value="{{$location['id']}}">{{$location['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Alat Pengambilan</label>
                                        <input type="text" class="form-control" name="tool" id="inputName" placeholder="Alat Pengambilan">
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Keluarga</label>
                                        <input type="number" min="1" name="family_amount" class="form-control" id="inputName" placeholder="Jumlah Keluarga">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Daftar</button>
                                    </div>
                            </div>
                        </div>
                    </div>
               </form>
                <div class="clearfix"> </div>
            </div>
        </div>

    </div>
</div>
@endsection
