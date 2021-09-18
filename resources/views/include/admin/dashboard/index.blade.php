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
                                                Doanh thu mua hàng</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($total_money)}} VNĐ</div>
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
                                                Số đơn hàng</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">{{$order}} đơn hàng</div>
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
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tổng số sản phẩm
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">{{$product}} sản phẩm</div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <h2>Sản phẩm hot:</h2>
                    <div class="row" id="document">
                        @foreach ($hot as $item)
        
                            @php
                                $id = $item['id'];
                            @endphp
                            <div class="col-lg-4 clo-md-4">
                                <div class="card border-left-primary shadow text-center py-2 " style="margin:15px 10px;">
                                    <a href="{{ asset('chi-tiet-san-pham/id=' . $id) }}" class="image_hover"><img
                                            src="{{ $item['image'] }}" alt="" style="height: 210px;
                                                            width: 160px; object-fit:contain; transition: width 2s, height 2s"
                                            class="mt-1 "></a>
                                    <div>
                                        <a href="{{ asset('chi-tiet-san-pham/id=' . $id) }}">
                                            <p style="padding-top: 10px; font-weight: bold; color:#000; height:50px">
                                                {!! $item['name'] !!}</p>
        
                                        </a>
                                        <div class="text-center">
                                            <p>Giá:
                                                @if ($item['price_sale'] == null)
                                                    <b>{{ number_format($item['price']) }} đ</b>
        
                                                @else <strike>{{ number_format($item['price']) }} đ </strike>
                                                    <b> {{ number_format($item['price_sale']) }} đ </b>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="text-center pb-3">
                                            <p>Số lần đặt hàng: {{ $item['total']}}</p>
                                           
                                        </div>
        
                                    </div>
        
                                </div>
                            </div>
                        @endforeach
        
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