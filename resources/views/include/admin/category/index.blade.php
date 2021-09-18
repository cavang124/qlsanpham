
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
                                <div class="text-right"><button class="btn btn-info m-2" data-toggle="modal" data-target="#add">Thêm mới +</button></div>
                                <div class="modal fade" id="add">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Thêm mới danh mục</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('category.store') }}" method="post" id="formAddcategory"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 ">
                                                                <div class="form-group">
                                                                    <label for="inputTitle">Tên danh mục</label>
                                                                    <input type="text" class="form-control" id="inputTitle" required name="title"
                                                                        placeholder="Tên danh mục sản phẩm">
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                            
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
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
                                            <th>Tên</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @foreach ($category as $index=>$item)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                {{-- <td></td> --}}
                                                <td>{{ $item['title'] }}</td>
                
                                                <td style="vertical-align: middle">
                                                
                                                    <a href="" data-toggle="modal" data-target="#update{{ $item['id'] }}"
                                                        class="btn btn-warning btn-circle btn-sm editcategory">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
    
                                                    <a class="btn btn-danger btn-circle btn-sm" href="" data-toggle="modal"
                                                        data-target="#delete{{ $item['id'] }}">
                                                        <i class="fas fa-trash"></i>
    
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="delete{{$item['id']}}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
    
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="p-5">
                                                                <div class="text-left">
                                                                    <h1 class="h4 text-gray-900 mb-4">Bạn có muốn xoá danh mục này?</h1>
                                                                    <div class="modal-body">
                                                                        <p>Tên danh mục: {{ $item['title']}}</p>
                                                                        <p>Chú ý: Khi xoá danh mục, các sản phẩm trong danh mục cũng sẽ bị xoá.</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-secondary" type="button"
                                                                            data-dismiss="modal">Không</button>
                                                                        <button type="submit" class="btn btn-primary"><a
                                                                                href="{{ route('category.delete', ['id'=>$item['id']]) }}"
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
                                                        <h4 class="modal-title">Cập nhật danh mục</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('category.update', ['id' => $item['id']]) }}"
                                                            method="post" id="formUpdatecategory"
                                                            enctype="multipart/form-data">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12 ">
                                                                        <div class="form-group">
                                                                            <label for="inputTitle">Tên danh mục:
                                                                            </label>
                                                                            <input type="text" class="form-control"
                                                                                id="inputTitle" required name="title"
                                                                                placeholder="Tên danh mục sản phẩm"
                                                                                value="{{ $item['title'] }}">
                                                                            <input type="text" hidden name="id"
                                                                                value="{{ $item['id'] }}">
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
