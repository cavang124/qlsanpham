
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Thêm mới đơn hàng: </h1>
                                </div>
                            
                                <form method="post" action="{{ route('order.store')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="code" id="" placeholder="Mã đơn hàng ..." class="form-control">
                                                </div>
                                            <select  name="user_id" id="" class="form-control w-80">
                                                <option value="">Chọn khách hàng</option>
                                                @foreach ($allUser as $ctv)
                                                    <option value="{{$ctv['id']}}">{{ $ctv['code_branch']}}-{{$ctv['code_ordinal']}} {{$ctv['name']}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" name="address_order" id="" placeholder="Địa chỉ người mua ..." class="form-control">
                                            </div>

                                            <div id="inputFormRow">
                                                <div class="input-group mb-3">
                                                    <select  name="product[]" id="" class="form-control w-80">
                                                        <option value="">Chọn sản phẩm</option>
                                                        @foreach ($allProduct as $product)
                                                            <option value="{{$product['id']}}">{{ $product['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="number" name="number[]" id="" placeholder="Số lượng sản phẩm" class="form-control ml-2 mr-2">                                                    
                                                    <div class="input-group-append">                
                                                        <button id="addRow" type="button" class="btn btn-info">Thêm +</button>
                                                    </div>
                                                </div>
                                            </div>
                                
                                            <div id="newRow"></div>
                                            
                                           <div class="text-center">
                                               <button class="btn btn-primary">Thêm mới</button>
                                           </div>
                                        </div>
                                    </div>
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
   
    <script type="text/javascript">
        // add row
        $("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += ' <select  name="product[]" id="" class="form-control">';
            html+= ' <option value="">Chọn sản phẩm</option>';
            html+= ' @foreach ($allProduct as $product)';
            html+= ' <option value="{{$product['id']}}">{{ $product['name']}}</option>';
            html+= ' @endforeach </select>';
            html+=' <input type="number" name="number[]" id="" placeholder="Số lượng sản phẩm" class="form-control ml-2 mr-2">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Xoá</button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>
</body>

</html>
