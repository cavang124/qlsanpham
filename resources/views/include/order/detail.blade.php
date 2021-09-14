<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Chi tiết đơn hàng</title>


    @include('layout/libcss')

</head>

<body id="page-top">

    <div id="wrapper">
        @include('layout/menu')
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('layout/header')

                <div class="container">
                    <h1 class="text-center leader-title">Chi tiết đơn hàng: </h1>
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="{{ route('order.update', ['id' => $infor['id']]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                        style="font-size: 15px;">
                                        <thead>

                                            <tr>
                                                <th>Họ tên người mua</th>
                                                <th>{{ $infor['user']['name'] }}</th>

                                            </tr>
                                            <tr>
                                                <th>SĐT người mua</th>
                                                <th>{{ $infor['user']['phone'] }}</th>

                                            </tr>
                                            <tr>
                                                <th>Địa chỉ người mua</th>
                                                <th>{{ $infor['address_order'] }}</th>

                                            </tr>
                                            <tr>
                                                <th>Tổng sản phẩm</th>
                                                <th>{!! $infor['total_product'] !!} <br>
                                                    <a data-toggle="modal" data-target="#detail" style="text-decoration: underline;
                                                       color: #4e73df;">
                                                        Chi tiết...
                                                    </a>
                                                    {{-- =========== modal chi tiet =============== --}}
                                                    <div class="modal fade" id="detail" tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Danh sách sản
                                                                        phẩm: </h5>
                                                                    <button class="close" type="button"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table">
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Tên sản phẩm</th>
                                                                            <th>Giá</th>
                                                                            <th>Số lượng mua</th>
                                                                        </tr>
                                                                        @foreach ($infor['detail'] as $index => $item)
                                                                            <tr>
                                                                                <td>{{ ++$index }}</td>
                                                                                <td>{{ $item['product']['name'] }}
                                                                                </td>
                                                                                <td>{{ number_format($item['price']) }}
                                                                                    đ</td>
                                                                                <td>{{ $item['number'] }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button"
                                                                        data-dismiss="modal">Đóng</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- ================================= --}}

                                                </th>

                                            </tr>

                                            <tr>
                                                <th>Tổng giá tiền</th>
                                                <th>
                                                    {{ number_format($infor['total_money']) }} đ
                                                </th>

                                            </tr>
                                            <tr>
                                                <th>Tiền ship</th>
                                                <th class="form-group">
                                                    <input type="text" class="form-control" name="ship" id="ship"
                                                        value="@if (isset($infor['ship']) && $infor['ship'] != null) {{ $infor['ship'] }} @endif"
                                                        placeholder="Nhập số tiền ship...">
                                                </th>

                                            </tr>
                                            <tr>
                                                <th>Trạng thái đơn hàng:</th>
                                                <th class="form-group">
                                                    <select name="status" class="form-control" id="">
                                                        <option value="1" @if ($infor['status'] == 1) {{ 'selected' }} @endif>Chờ xác
                                                            nhận</option>
                                                        <option value="2" @if ($infor['status'] == 2) {{ 'selected' }} @endif>Đã xác
                                                            nhận</option>
                                                        <option value="3" @if ($infor['status'] == 3) {{ 'selected' }} @endif>Đang giao
                                                            hàng</option>
                                                        <option value="4" @if ($infor['status'] == 4) {{ 'selected' }} @endif>Đã giao
                                                            hàng</option>
                                                        <option value="5" @if ($infor['status'] == 5) {{ 'selected' }} @endif>Đã huỷ
                                                        </option>
                                                    </select>
                                                </th>

                                            </tr>
                                            <tr>
                                                <th>Thời gian mua</th>
                                                <th>{{ date(' d-m-Y', strtotime($infor['created_at'])) }}</th>

                                            </tr>
                                            <tr>
                                                <th colspan="2" class="text-center"><button class="btn btn-primary"
                                                        type="submit">Cập nhật</button>
                                                </th>

                                            </tr>
                                        </thead>

                                    </table>
                                </form>
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
