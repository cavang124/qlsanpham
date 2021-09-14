
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đơn hàng</title>


    @include('layout/libcss')

</head>

<body id="page-top">

    <div id="wrapper">
        @include('layout/menu')
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('layout/header')

                <div class="container">
                    <h1 class="text-center leader-title">Danh sách đơn hàng</h1>
                    <form action="" id="search_lucky" method="get">
                        <div class="row m-2">
                            <div class="col-md-4 col-lg-4">
                                <input type="text" name="code" id="name" value="{{request('code')}}" placeholder="Mã đơn hàng" class="form-control">
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <?php
                                        $status = '';
                                        if(isset($_GET['status']))
                                        {
                                            $status = $_GET['status'];
                                        }
                                ?>
                                <select class="form-control" id="status" name="status">
                                        <option value="">--Trạng thái--</option>
                                        <option value="1" @if(isset($status) && $status == 1) selected @endif>Chờ xác nhận</option>
                                        <option value="2" @if(isset($status) && $status == 2) selected @endif>Đã xác nhận</option>
                                        <option value="3" @if(isset($status) && $status == 3) selected @endif>Đang giao hàng</option>
                                        <option value="4" @if(isset($status) && $status == 4) selected @endif>Đã hoàn thành</option>
                                        <option value="5" @if(isset($status) && $status == 5) selected @endif>Đã huỷ</option>



                                </select>
                            </div>
                            <div class="col-md-4 col-lg-4 text-center ">
                                <button type="submit" class="btn btn-primary mr-2 search"><i class="fa fa-search"></i> Tìm kiếm</button>
                            </div>
                        </div>
                     
                    </form>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                    style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mã đơn hàng</th>
                                            <th>Tên người đặt</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Tổng số tiền</th>
                                            <th>Tổng số lượng</th>
                                            <th>Ship</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                 
                                        @foreach ($listOrder as $index=>$item)
                                            @php
                                                $status = '';
                                                if($item['status'] == 1){
                                                    $status = 'Chờ xác nhận';
                                                }
                                                elseif($item['status'] == 2){
                                                    $status = 'Đã xác nhận';
                                                }
                                                elseif($item['status'] == 3){
                                                    $status = 'Đang giao hàng';
                                                }
                                                elseif($item['status'] == 4){
                                                    $status = 'Đã hoàn thành';
                                                }
                                                elseif($item['status'] == 5){
                                                    $status = 'Đã huỷ';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                {{-- <td></td> --}}
                                                <td>{{ $item['code'] }}</td>
                                                <td>{{ $item['user']['name']}}</td>
                                                <td>{{ $item['user']['phone']}}</td>
                                                <td>{{ $item['address_order'] }}</td>
                                                <td>{{ number_format($item['total_money'])}} đ</td>
                                                <td>{{ $item['total_product']}}</td>
                                                <td>{{ number_format($item['ship'])}} đ</td>
                                                <td>{{ $status }}</td>
                                                <td style="vertical-align: middle">
                                                
                                                    <a href="" data-toggle="modal" data-target="#update{{ $item['id'] }}"
                                                        class="btn btn-warning btn-circle btn-sm editcategory">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
    
                                                    <a class="btn btn-info btn-circle btn-sm" href="{{route('order.detail', ['id' => $item['id']])}}">
                                                        <i class="fas fa-info-circle"></i>
    
                                                    </a>
                                                </td>
                                            </tr>
                                

                                          {{-- update --}}
                                          <div class="modal fade" id="update{{ $item['id'] }}">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Cập nhật đơn hàng</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('order.update', ['id' => $item['id']]) }}"
                                                            method="post" id="formUpdatecategory"
                                                            enctype="multipart/form-data">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12 ">
                                                                        <div class="form-group">
                                                                            
                                                                            <label for="">Mã đơn hàng</label>
                                                                            <input type="text" class="form-control"  required name="code"
                                                                              readonly value="{{ $item['code'] }}" readonly>
                                                                            <label for="">Phí ship</label>
                                                                            <input type="number" class="form-control"  name="ship"
                                                                                    value="{{ $item['ship'] }}">
                                                                            <label for="">Trạng thái:</label>
                                                                            <select name="status" id="" class="form-control">
                                                                                <option value="1" @if($item['status'] == 1) {{'selected'}} @endif>Chờ xác nhận</option>
                                                                                <option value="2" @if($item['status'] == 2) {{'selected'}} @endif>Đã xác nhận</option>
                                                                                <option value="3" @if($item['status'] == 3) {{'selected'}} @endif>Đang giao hàng</option>
                                                                                <option value="4" @if($item['status'] == 4) {{'selected'}} @endif>Đã giao hàng</option>
                                                                                <option value="5" @if($item['status'] == 5) {{'selected'}} @endif>Đã huỷ</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- /.card-body -->

                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Đóng</button>
                                                                <button type="submit" class="btn btn-primary">Lưu
                                                                    lại</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        {{-- ---------- --}}
                                        @endforeach
                                       
                                        {{ $listOrder->links('pagination::bootstrap-4') }}

                                    </tbody>
                                </table>

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
