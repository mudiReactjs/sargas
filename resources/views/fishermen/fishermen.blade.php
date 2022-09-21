@extends('layout.general')
@section('content')

<div class="main-page" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-3">
            <div class="r3_counter_box">
                <a href="{{route('location.index')}}">
                    <i class="pull-left fa fa-money user2 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>Master Lokasi</strong></h5>
                        <span>Expenses</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="r3_counter_box">
                <a href="{{route('product.index')}}">
                    <i class="pull-left fa fa-money user2 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>Master Produk</strong></h5>
                        <span>Expenses</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="r3_counter_box">
                <a href="{{route('debt.form')}}">
                    <i class="pull-left fa fa-pie-chart dollar1 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>Kas Bon</strong></h5>
                        <span>Expenditure</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="r3_counter_box">
                <a href="{{route('sack.form')}}">
                    <i class="pull-left fa fa-pie-chart dollar1 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>Karung</strong></h5>
                        <span>Expenditure</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 r3_counter_box_hover">
            <div class="r3_counter_box">
                <a href="{{route('fishermen.create')}}" class="">
                    <i class="pull-left fa fa-dollar icon-rounded"></i>
                        <div class="stats">
                        <h5><strong>Add Nelayan</strong></h5>
                        <span>Total Revenue</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="r3_counter_box">
                <a href="{{route('fishermen.list')}}">
                    <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>Data Nelayan</strong></h5>
                        <span>Online Revenue</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection

