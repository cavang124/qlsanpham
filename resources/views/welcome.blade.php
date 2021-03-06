<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Login</title>
    @include('layout/libcss')
</head>

<body class="bg-gradient-primary">
  
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background:url({{ asset('img/sunset.jpg') }})"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <div style="margin-top: 50px;">

                                    </div>
                                    <form class="user" method="post" action="{{route('login')}}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="phone" name="phone" aria-describedby="emailHelp"
                                                placeholder="Nhập số điện thoại">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="" name="password" placeholder="Password">
                                        </div>
                                        {{-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> --}}
                                        <div style="margin-top: 50px;">

                                        </div>
                                        <button type="submit" style="border: none;background: #fff;width: 100%;">
                                            <a class="btn btn-primary btn-user btn-block">
                                                Đăng nhập
                                            </a>
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <div class="small">Bạn muốn đăng nhập với: 
                                            <a href="{{ route('loginFacebook')}}" class="mr-2"><i class="fab fa-facebook-square fa-3x"></i></a>
                                            {{-- <a href=""><i class="fab fa-google-plus-square fa-3x"></i></a> --}}
                                        </div>

                                        
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="dang-ki">Bạn chưa có tài khoản? Đăng kí!</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @include('layout/libjs')

</body>
</html>