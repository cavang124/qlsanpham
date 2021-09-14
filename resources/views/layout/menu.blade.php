<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{asset('trang-chu')}}">
        <div class="">
            <img src="{{asset('img/logo.png')}}" alt="" height="70px" class="logo_cms">
        </div>
        <div class="sidebar-brand-text mx-3"></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">



    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('category.index')}}" >
            <i class="fas fa-fw fa-wallet"></i>
            <span>Danh mục</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('product.index')}}">
            <i class="fas fa-fw fa-wallet"></i>
            <span>Sản phẩm</span>
        </a>
        {{-- <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{asset('goi-sua')}}">Danh sách gói sữa</a>
                <a class="collapse-item" href="{{asset('goi-mua-sua')}}">Danh sách mua gói sữa</a>  
            </div>
        </div> --}}
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Đơn hàng</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('order.create')}}">Thêm mới</a>
                <a class="collapse-item" href="{{route('order.index')}}">Danh sách</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('user.index')}}" >
            <i class="fas fa-fw fa-wallet"></i>
            <span>Người dùng</span>
        </a>
    </li>
    

    <!-- Divider -->
    <hr class="sidebar-divider">

    



    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>