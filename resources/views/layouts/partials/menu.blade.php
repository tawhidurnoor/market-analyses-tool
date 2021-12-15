<!-- Mobile Menu start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul class="mobile-menu-nav">
                            <li>
                                <a data-toggle="collapse" data-target="#Charts" href="/">Home</a>
                            </li>
                            <li><a data-toggle="collapse" data-target="#demoevent" href="#">User Management</a>
                                <ul id="demoevent" class="collapse dropdown-header-top">
                                    <li><a href="{{route('users.index')}}">Users</a>
                                    </li>
                                    <li><a href="{{route('roles.index')}}">User Roles</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#demoevent" href="#">Product Management</a>
                                <ul id="demoevent" class="collapse dropdown-header-top">
                                    <li><a href="{{route('category.index')}}">Product Category</a>
                                    </li>
                                    <li><a href="{{route('product.index')}}">Product List</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Menu end -->
<!-- Main Menu area start-->
<div class="main-menu-area mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">

                    <li class="{{ ( request()->segment(1)=='' ) ? 'active':'' }}"> <a href="/">
                            <i class="fa fa-tachometer" aria-hidden="true"></i> Home</a>
                    </li>

                    <li class="{{ ( request()->segment(1)=='report') ? 'active':'' }}">
                        <a data-toggle="tab" href="#reportManagement"><i class="fa fa-file-text" aria-hidden="true"></i> Market Analysis Report</a>
                    </li>

                    <li class="{{ ( request()->segment(1)=='roles' || request()->segment(1)=='users' ) ? 'active':'' }}">
                        <a data-toggle="tab" href="#userManagement"><i class="fa fa-users" aria-hidden="true"></i> User Management</a>
                    </li>

                    <li class="{{ ( request()->segment(1)=='products' ) ? 'active':'' }}">
                        <a data-toggle="tab" href="#productManagement"><i class="fa fa-cube" aria-hidden="true"></i> Products</a>
                    </li>

                    <li class="{{ ( request()->segment(1)=='sale' ) ? 'active':'' }}"> <a href="{{route('sale.index')}}">
                            <i class="fa fa-money" aria-hidden="true"></i> Sale</a>
                    </li>

                </ul>

                <!-- Bellow gose the nested item of any tab, will be copied from tempete file if needed -->
                <div class="tab-content custom-menu-content">

                    <div id="userManagement" class="tab-pane {{ ( request()->segment(1)=='roles' || request()->segment(1)=='users' ) ? 'active':'' }} notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="{{route('users.index')}}">Users</a>
                            </li>
                            <li><a href="{{route('roles.index')}}">User Roles</a>
                            </li>
                        </ul>
                    </div>

                    <div id="productManagement" class="tab-pane {{ ( request()->segment(1)=='products' ) ? 'active':'' }} notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="{{route('category.index')}}">Product Category</a>
                            </li>
                            <li><a href="{{route('product.index')}}">Product List</a>
                            </li>
                        </ul>
                    </div>

                    <div id="reportManagement" class="tab-pane {{ ( request()->segment(1)=='report' ) ? 'active':'' }} notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="{{route('report.trending')}}">Trending Right Now</a>
                            </li>
                            <li><a href="{{route('report.analysis')}}">Analysis</a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Main Menu area End-->