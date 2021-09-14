
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Người dùng</title>


    @include('layout/libcss')

</head>

<body id="page-top">

    <div id="wrapper">
        @include('layout/menu')
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('layout/header')

                <div class="container">
                    <h1 class="text-center leader-title">Danh sách người dùng</h1>
                    <form action="" method="get">
                        <div class="row m-2">
                            <div class="col-md-4 col-lg-4">
                                <input type="text" name="name" id="name" value="{{request('name')}}" placeholder="Tên người dùng ..." class="form-control">
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <input type="number" name="phone" id="phone" value="{{request('phone')}}" placeholder="SĐT người dùng ..." class="form-control">
                            </div>
                            <div class="col-md-2 col-lg-2 text-center ">
                                <button type="submit" class="btn btn-primary mr-2 search"><i class="fa fa-search"></i> Tìm kiếm</button>
                            </div>
                            <div class="col-md-2 col-lg-2 text-center ">
                                <a class="btn btn-info mr-2 " data-toggle="modal" data-target="#add" >Thêm mới</a>
                            </div>
                        </div>
                     
                    </form>

                    <div class="modal fade" id="add">
                        <div class="modal-dialog modal-dialog-centered ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Thêm mới người dùng</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('user.store') }}" method="post" id="formAddcategory"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 ">
                                                    <div class="form-group">
                                                        <label for="">Tên người dùng</label>
                                                        <input type="text" class="form-control" id="" required name="name"
                                                            placeholder="Tên người dùng">
                                                        <label for="">Email</label>
                                                        <input type="email" class="form-control" id="" required name="email"
                                                            placeholder="Email người dùng">
                                                         <label for="">Số điện thoại</label>
                                                        <input type="number" class="form-control" id="" required name="phone"
                                                            placeholder="SĐT người dùng">
                                                         <label for="">Mật khẩu</label>
                                                        <input type="password" class="form-control" id="" required name="password"
                                                            placeholder="Mật khẩu người dùng">
                                                        <label for="">Nhập lại mật khẩu</label>
                                                        <input type="password" class="form-control" id="" required name="repassword"
                                                            placeholder="Nhập lại mật khẩu">
                                                        <label for="">Vai trò</label>
                                                        <select name="role_id" id="" class="form-control">
                                                            <option value="1">Admin</option>
                                                            <option value="2">Khách hàng</option>
                                                        </select>
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


                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                    style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên người dùng</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Vai trò</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                 
                                        @foreach ($listUser as $index=>$item)
                                            @php
                                                $role = '';
                                                if($item['role_id'] == 1){
                                                    $role = 'Admin';
                                                }
                                                elseif($item['role_id'] == 2){
                                                    $role = 'Khách hàng';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                {{-- <td></td> --}}
                                                <td>{{ $item['name'] }}</td>
                                                <td>{{ $item['email']}}</td>
                                                <td>{{ $item['phone']}}</td>
                                                <td>{{ $role }}</td>
                                              
                                                <td style="vertical-align: middle">
                                                
                                                    <a href="" data-toggle="modal" data-target="#update{{ $item['id'] }}"
                                                        class="btn btn-warning btn-circle btn-sm editcategory">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
    
                                                    <a class="btn btn-danger btn-circle btn-sm" href="" data-toggle="modal" data-target="#delete{{ $item['id'] }}">
                                                        <i class="fas fa-trash"></i>
    
                                                    </a>
                                                </td>
                                            </tr>
                                

                                          {{-- update --}}
                                          <div class="modal fade" id="update{{ $item['id'] }}">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Cập nhật người dùng</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('user.update', ['id' => $item['id']]) }}"
                                                            method="post" id="formUpdatecategory"
                                                            enctype="multipart/form-data">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12 ">
                                                                        <div class="form-group">
                                                                            
                                                                            <label for="">Họ tên</label>
                                                                            <input type="text" class="form-control"  required name="name"
                                                                              readonly value="{{ $item['name'] }}" readonly>
                                                                            <label for="">Email</label>
                                                                            <input type="email" class="form-control"  name="email" required
                                                                                    value="{{ $item['email'] }}">
                                                                            <label for="">Số điện thoại</label>
                                                                            <input type="number" class="form-control"  name="phone" required
                                                                                    value="{{ $item['phone'] }}">
                                                                            <label for="">Vai trò:</label>
                                                                            <select name="status" id="" class="form-control">
                                                                                <option value="1" @if($item['role_id'] == 1) {{'selected'}} @endif>Admin</option>
                                                                                <option value="2" @if($item['role_id'] == 2) {{'selected'}} @endif>Khách hàng</option>
                                                        

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


                                        {{-- --- delete --------- --}}
                                        <div class="modal fade" id="delete{{$item['id']}}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
    
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="p-5">
                                                                <div class="text-left">
                                                                    <h1 class="h4 text-gray-900 mb-4">Bạn có muốn xoá người dùng này?</h1>
                                                                    
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-secondary" type="button"
                                                                            data-dismiss="modal">Không</button>
                                                                        <button type="submit" class="btn btn-primary"><a
                                                                                href="{{ route('user.delete', ['id'=>$item['id']]) }}"
                                                                                style="color: #fff;">Có</a></button>
                                                                    </div>
    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
    
    
                                            </div>
                                        </div>

                                        @endforeach
                                       
                                        {{ $listUser->links('pagination::bootstrap-4') }}

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
