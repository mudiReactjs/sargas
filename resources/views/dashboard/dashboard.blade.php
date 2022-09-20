@extends('layout.general')
@section('content')
<div class="main-page" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-3">
            <div class="r3_counter_box">
                <i class="pull-left fa fa-dollar icon-rounded"></i>
                <div class="stats">
                <h5><strong>$452</strong></h5>
                <span>Total Revenue</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="r3_counter_box">
                <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                <div class="stats">
                <h5><strong>$1019</strong></h5>
                <span>Online Revenue</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="r3_counter_box">
                <i class="pull-left fa fa-money user2 icon-rounded"></i>
                <div class="stats">
                <h5><strong>$1012</strong></h5>
                <span>Expenses</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="r3_counter_box">
                <i class="pull-left fa fa-pie-chart dollar1 icon-rounded"></i>
                <div class="stats">
                <h5><strong>$450</strong></h5>
                <span>Expenditure</span>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>

<div class="row-one widgettable">
    <div class="col-md-8 content-top-2 card">
        <div class="agileinfo-cdr">
            <div class="card-header">
                <h3>Weekly Sales</h3>
            </div>

            <div id="chartdiv"  style="width: 100%; height: 350px;"></div>


        </div>
    </div>
    <div class="col-md-4 stat">
        <div class="content-top-1">
            <div class="col-md-6 top-content">
                <h5>Sales</h5>
                <label>1283+</label>
            </div>
            <div class="col-md-6 top-content1">
                <div id="demo-pie-1" class="pie-title-center" data-percent="45"> <span class="pie-value"></span> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="content-top-1">
        <div class="col-md-6 top-content">
            <h5>Reviews</h5>
            <label>2262+</label>
        </div>
        <div class="col-md-6 top-content1">
            <div id="demo-pie-2" class="pie-title-center" data-percent="75"> <span class="pie-value"></span> </div>
        </div>
        <div class="clearfix"> </div>
        </div>
        <div class="content-top-1">
        <div class="col-md-6 top-content">
            <h5>Visitors</h5>
            <label>12589+</label>
        </div>
        <div class="col-md-6 top-content1">
            <div id="demo-pie-3" class="pie-title-center" data-percent="90"> <span class="pie-value"></span> </div>
        </div>
        <div class="clearfix"> </div>
        </div>
    </div>
</div>

<div class="row-two charts">
    <div class="col-md-12 charts-grids widget" style="padding: 30px;">
        <div class="product-card bg-1">
            <div class="transaction-product">
                <div class="desc">
                    <span class="title">Transaksi Barang</span>
                    <span class="caract">|</span>
                    <span class="sub-title">Sargassum</span>
                </div>
                <div class="date">
                    <span>02 September 2022</span>
                </div>
            </div>
        </div>
        <div class="description bg-1">
            <div class="row">
                <div class="col-md-4">
                    <div class="group-desc">
                        <label>NO TRANSAKSI</label>
                        <input type="text" class="form-control" disabled value="TR.123456789">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="group-desc">
                        <label>QUANTITY</label>
                        <input type="text" class="form-control" value="200 PCS" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="group-desc">
                        <label>NOMINAL</label>
                        <input type="text" class="form-control" value="RP. 600.000" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="officer">
            <div class="officer-left">
                <div style="width: 100%;">
                    <div class="officer-group-left">
                        <label>Petugas</label>
                        <input type="text" class="form-control" value="Nur Shidiq" disabled>
                    </div>
                    <div class="officer-group-left">
                        <label>Lokasi</label>
                        <input type="text" class="form-control" value="Teluk Awur" disabled>
                    </div>
                    <div class="officer-group-right">
                        <button class="btn btn-primary">Validasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"> </div>
</div>
<div class="row-two charts">
    <div class="col-md-12 charts-grids widget" style="padding: 30px;">
        <div class="product-card bg-2">
            <div class="transaction-product bg-2">
                <div class="desc">
                    <span class="title">Transaksi Barang</span>
                    <span class="caract">|</span>
                    <span class="sub-title">Sargassum</span>
                </div>
                <div class="date">
                    <span>02 September 2022</span>
                </div>
            </div>
        </div>
        <div class="description bg-2">
            <div class="row">
                <div class="col-md-4">
                    <div class="group-desc">
                        <label>NO TRANSAKSI</label>
                        <input type="text" class="form-control" disabled value="TR.123456789">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="group-desc">
                        <label>QUANTITY</label>
                        <input type="text" class="form-control" value="200 PCS" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="group-desc">
                        <label>NOMINAL</label>
                        <input type="text" class="form-control" value="RP. 600.000" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="officer">
            <div class="officer-left">
                <div style="width: 100%;">
                    <div class="officer-group-left">
                        <label>Petugas</label>
                        <input type="text" class="form-control" value="Nur Shidiq" disabled>
                    </div>
                    <div class="officer-group-left">
                        <label>Lokasi</label>
                        <input type="text" class="form-control" value="Teluk Awur" disabled>
                    </div>
                    <div class="officer-group-right">
                        <button class="btn btn-primary">Validasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"> </div>
</div>
<div class="row-two charts">
    <div class="col-md-12 charts-grids widget" style="padding: 30px;">
        <div class="product-card bg-3">
            <div class="transaction-product">
                <div class="desc">
                    <span class="title">Transaksi Barang</span>
                    <span class="caract">|</span>
                    <span class="sub-title">Sargassum</span>
                </div>
                <div class="date">
                    <span>02 September 2022</span>
                </div>
            </div>
        </div>
        <div class="description bg-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="group-desc">
                        <label>NO TRANSAKSI</label>
                        <input type="text" class="form-control" disabled value="TR.123456789">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="group-desc">
                        <label>QUANTITY</label>
                        <input type="text" class="form-control" value="200 PCS" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="group-desc">
                        <label>NOMINAL</label>
                        <input type="text" class="form-control" value="RP. 600.000" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="officer">
            <div class="officer-left">
                <div style="width: 100%;">
                    <div class="officer-group-left">
                        <label>Petugas</label>
                        <input type="text" class="form-control" value="Nur Shidiq" disabled>
                    </div>
                    <div class="officer-group-left">
                        <label>Lokasi</label>
                        <input type="text" class="form-control" value="Teluk Awur" disabled>
                    </div>
                    <div class="officer-group-right">
                        <button class="btn btn-primary">Validasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"> </div>
</div>


<!-- for amcharts js -->
<script src="{{asset('assets/js/amcharts.js')}}"></script>
<script src="{{asset('assets/js/serial.js')}}"></script>
<script src="{{asset('assets/js/export.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets/css/export.css')}}" type="text/css" media="all" />
<script src="{{asset('assets/js/light.js')}}"></script>
<!-- for amcharts js -->

<script  src="{{asset('assets/js/index1.js')}}"></script>
@endsection
