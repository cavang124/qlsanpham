<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang chủ</title>


    @include('layout/libcss')

</head>

<body id="page-top">

    <div id="wrapper">
        @include('layout/menu')
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('layout/header')
                
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        {{-- <h1 class="h4 mb-0 text-gray-800">Xin chào, {{$infor['name']}}</h1> --}}
                    </div>
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Doanh thu mua hàng theo tháng</div>
                                            {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($dashboard['ctv']['revuene_month'])}} VNĐ</div> --}}
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Số Gói sữa đã mua theo tháng</div>
                                            {{-- <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">{{$dashboard['ctv']['quantity_packet_month']}}</div> --}}
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tổng doanh thu cây hệ thống
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    {{-- <div class=" mb-0 font-weight-bold text-gray-800">-Tháng: {{number_format($dashboard['ctv']['revenue_ctv_month'])}} VNĐ</div>
                                                    <div class="mb-0  font-weight-bold text-gray-800">-Ngày: {{number_format($dashboard['ctv']['revenue_ctv_day'])}} VNĐ</div> --}}
                                                </div>
                                                
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Tổng số thành viên cấp dưới</div>
                                            {{-- <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">{{$dashboard['ctv']['quantity_ctv_total']}}</div> --}}
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @include('layout/footer')
        </div>
        

    </div>
    


    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    

    @include('layout/libjs')

</body>

</html>