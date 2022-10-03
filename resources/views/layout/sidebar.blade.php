<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
    <!--left-fixed -navigation-->
    <aside class="sidebar-left">
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                    <div class="" style="text-align:center">
                        <img src="{{asset('assets/images/icon-logo.png')}}" alt="" width="40"> <br>
                        <img src="{{asset('assets/images/text-logo.png')}}" alt="" height="20">
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="sidebar-menu">
                    <li class="treeview @if(Request::routeIs('home')) active @endif">
                        <a href="{{route('home')}}">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview @if(Request::routeIs('fishermen*', 'location*', 'product*', 'sack*', 'debt*')) active @endif">
                        <a href="{{route('fishermen.index')}}">
                            <i class="fa fa-dashboard"></i> <span>Nelayan</span>
                        </a>
                    </li>
                    <li class="treeview @if(Request::is('dashboard/transactions*')) active @endif">
                        <a href="{{route('tr.index')}}">
                            <i class="fa fa-dashboard"></i> <span>Transaksi Produk</span>
                        </a>
                    </li>
                    <li class="treeview @if(Request::routeIs('mto.home', 'mto.index', 'to.form')) active @endif">
                        <a href="{{route('mto.home')}}">
                            <i class="fa fa-dashboard"></i> <span>Transaksi Operasional</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </aside>
</div>
