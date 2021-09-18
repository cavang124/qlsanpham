<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Danh mục</title>


    @include('layout/libcss')

</head>

<body id="page-top">

    <div id="wrapper">
        @include('layout/menu')
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('layout/header')

                <div class="container">
                    <h1 class="text-center leader-title">Danh sách danh mục sản phẩm</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="text-right"><button class="btn btn-info m-2" data-toggle="modal"
                                        data-target="#add">Thêm mới +</button></div>
                                <div class="modal fade" id="add">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Thêm mới sản phẩm</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('product.store') }}" method="post"
                                                    id="formAddcategory" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 ">
                                                                <div class="form-group">
                                                                    <label for="inputTitle">Danh mục</label>
                                                                    <select name="category_id" id=""
                                                                        class="form-control">
                                                                        <option value="">Chọn danh mục</option>
                                                                        @foreach ($category as $cate)
                                                                            <option value="{{ $cate['id'] }}">
                                                                                {{ $cate['title'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="inputTitle">Mã sản phẩm</label>
                                                                    <input type="text" class="form-control"
                                                                        name="code">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="inputTitle">Tên sản phẩm</label>
                                                                    <input type="text" class="form-control"
                                                                        name="name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="inputTitle">Giá</label>
                                                                    <input type="number" class="form-control"
                                                                        name="price">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputTitle">Số lượng</label>
                                                                    <input type="number" class="form-control"
                                                                        name="number">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputTitle">Ngày hết hạn</label>
                                                                    <input type="date" class="form-control"
                                                                        name="date_expired">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="inputTitle">Ảnh</label>
                                                                    <input type="file" class="form-control"
                                                                        name="image">
                                                                </div>

                                                            </div>


                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->

                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                    style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Ảnh</th>
                                            <th>Tên</th>
                                            <th>Loại</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Ngày hết hạn</th>
                                            <th>Tình trạng</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($listProduct as $index => $item)
                                            @php
                                                if($item['status'] == 1) {
                                                    $status = 'Đang bán';
                                                }else if($item['status'] == 2){
                                                    $status = 'Hết hàng';
                                                }else if($item['status'] == 3){
                                                    $status = 'Hết hạn';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                {{-- <td></td> --}}
                                                <td>{{ $item['code'] }}</td>
                                                <td><img src="{{ $item['image'] }}" alt=""
                                                        style="max-width:200px; max-height: 200px"></td>
                                                <td>{{ $item['name'] }}</td>
                                                <td>{{ $item['category']['title'] }}</td>
                                                <td>{{ number_format($item['price']) }}</td>
                                                <td>{{ $item['number'] }}</td>
                                                <td>{{ $item['date_expired'] }}</td>
                                                <td>{{ $status }}</td>
                                                <td style="vertical-align: middle">

                                                    <a href="" data-toggle="modal"
                                                        data-target="#update{{ $item['id'] }}"
                                                        class="btn btn-warning btn-circle btn-sm editcategory">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <a class="btn btn-danger btn-circle btn-sm" href=""
                                                        data-toggle="modal" data-target="#delete{{ $item['id'] }}">
                                                        <i class="fas fa-trash"></i>

                                                    </a>
                                                </td>
                                            </tr>


                                            <div class="modal fade" id="delete{{ $item['id'] }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">

                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="p-5">
                                                                    <div class="text-left">
                                                                        <h1 class="h4 text-gray-900 mb-4">Bạn có muốn
                                                                            xoá sản phẩm này?</h1>
                                                                        <div class="modal-body">
                                                                            <p>Tên sản phẩm: {{ $item['name'] }}</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-secondary"
                                                                                type="button"
                                                                                data-dismiss="modal">Không</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary"><a
                                                                                    href="{{ route('product.delete', ['id' => $item['id']]) }}"
                                                                                    style="color: #fff;">Có</a></button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>

                                            {{-- update --}}
                                            <div class="modal fade" id="update{{ $item['id'] }}">
                                                <div class="modal-dialog modal-dialog-centered ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Cập nhật sản phẩm</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('product.update', ['id' => $item['id']]) }}"
                                                                method="post" id="formUpdatecategory"
                                                                enctype="multipart/form-data">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12 ">
                                                                            <div class="form-group">
                                                                                <label for="">Danh mục:
                                                                                </label>
                                                                                <select name="category_id" id=""
                                                                                    class="form-control">

                                                                                    @foreach ($category as $cate2)
                                                                                        <option
                                                                                            value="{{ $cate2['id'] }}"
                                                                                            @if ($item['category_id'] == $cate2['id']) {{ 'selected' }} @endif>
                                                                                            {{ $cate2['title'] }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <label for="">Mã sản phẩm</label>
                                                                                <input type="text"
                                                                                    class="form-control" required
                                                                                    name="code" readonly
                                                                                    value="{{ $item['code'] }}">
                                                                                <input type="text" hidden name="id"
                                                                                    value="{{ $item['id'] }}">
                                                                                <label for="">Tên sản phẩm</label>
                                                                                <input type="text"
                                                                                    class="form-control" required
                                                                                    name="name"
                                                                                    value="{{ $item['name'] }}">
                                                                                <label for="">Giá</label>
                                                                                <input type="number"
                                                                                    class="form-control" required
                                                                                    name="price"
                                                                                    value="{{ $item['price'] }}">
                                                                                <label for="">Số lượng</label>
                                                                                <input type="number"
                                                                                    class="form-control" required
                                                                                    name="number"
                                                                                    value="{{ $item['number'] }}">
                                                                                <label for="">Ngày hết hạn</label>
                                                                                <input type="date"
                                                                                    class="form-control" required
                                                                                    name="date_expired">
                                                                                <label for="">Ảnh</label>
                                                                                <input type="file"
                                                                                    class="form-control" name="image">
                                                                                <img src="{{ $item['image'] }}" alt=""
                                                                                    style="max-width:200px; max-height: 200px">
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
                                        {{ $listProduct->links('pagination::bootstrap-4') }}



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
