<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;
use App\Mail\SendMail as SendEmail;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Contracts\Factory as Socialite;

class UserController extends Controller
{
    public function __construct(Socialite $socialite)
    {
        $this->socialite = $socialite;
    }

    public function login(Request $request)
    {
        if ($request) {
            $input = $request->only('phone', 'password');
            $input['role_id'] = 1;
            Validator::make(
                $request->all(),
                [
                    'phone' => 'required',
                    'password' => 'required|min:6',
                ],
                [
                    'phone.required' => 'Vui lòng nhập số điện thoại',
                    'password.required' => 'Vui lòng nhập mật khẩu',
                    'password.required' => 'Mật khẩu không được dưới :min ký tự',
                ],
            );
            if (Auth::attempt($input)) {
                alert()->success('Đăng nhập thành công');
                $url = redirect()
                    ->route('home')
                    ->getTargetUrl();
                return redirect($url);
            }
            alert()->error('Số điện thoại hoặc mật khẩu không chính xác!');
            return view('welcome');
        } else {
            return view('welcome');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return view('welcome');
    }

    public function index(Request $request)
    {
        $where = [];
        if ($request->name) {
            $where[] = ['name', 'like', '%' . $request->name . '%'];
        }
        if ($request->phone) {
            $where[] = ['phone', 'like', '%' . $request->phone . '%'];
        }

        $listUser = User::where($where)
            ->orderby('id', 'desc')
            ->paginate(12);
        return view('include.user.index', compact('listUser'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|unique:users|email',
                'phone' => 'required|unique:users',
                'role_id' => 'required',
                'password' => 'required|min:6|same:repassword',
            ],
            [
                'name.required' => 'Vui lòng nhập tên người dùng',
                'email.required' => 'Vui lòng nhập email người dùng',
                'email.unique' => 'Email người dùng đã tồn tại',
                'email.email' => 'Vui lòng nhập đúng định dạng email',
                'phone.required' => 'Vui lòng nhập số điện thoại người dùng',
                'phone.unique' => 'Số điện thoại người dùng đã tồn tại',
                'role_id.required' => 'Vui lòng chọn vai trò người dùng',
                'password.required' => 'Vui lòng nhập mật khẩu cho người dùng',
                'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
                'password.same' => 'Mật khẩu không trùng khớp.',
            ],
        );

        if ($validator->fails()) {
            alert()->warning($validator->getMessageBag()->first());
            return redirect()->back();
        }

        $req = $request->all();
        $req['password'] = Hash::make($request->password);
        $data = User::create($req);
        $mail = $request->email;
        $messages = 'Bạn đã đăng ký thành công tài khoản!' . 'Tài khoản: ' . $request->phone . 'Mật khẩu: ' . $request->password;
        $subject = 'Ngọc Bích thông báo';
        if ($data) {
            Mail::to($mail)->send(new SendEmail($subject, $messages));
        }
        alert()->success('Thêm mới người dùng thành công! Kiểm tra email để nhận thông tin tài khoản!');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'role_id' => 'required',
                'password' => 'required|min:6|same:repassword',
            ],
            [
                'name.required' => 'Vui lòng nhập tên người dùng',
                'email.required' => 'Vui lòng nhập email người dùng',
                'email.email' => 'Vui lòng nhập đúng định dạng email',
                'phone.required' => 'Vui lòng nhập số điện thoại người dùng',
                'role_id.required' => 'Vui lòng chọn vai trò người dùng',
                'password.required' => 'Vui lòng nhập mật khẩu cho người dùng',
                'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
                'password.same' => 'Mật khẩu không trùng khớp.',
            ],
        );

        if ($validator->fails()) {
            alert()->warning($validator->getMessageBag()->first());
            return redirect()->back();
        }

        $req = $request->all();
        $req['password'] = Hash::make($request->password);
        $data = User::findorfail($id);
        $data->update($req);
        alert()->success('Cập nhật người dùng thành công!');
        return redirect()->back();
    }

    public function delete($id)
    {
        $order = Order::where('user_id', $id)->count();
        if ($order > 0) {
            alert()->error('Người dùng đã đặt đơn nên không thể xoá!');
            return redirect()->back();
        } else {
            $delete = User::find($id)->delete();
            alert()->success('Xóa người dùng thành công!');
            return redirect()->back();
        }
    }

    public function loginFacebook()
    {
        return $this->socialite->with('facebook')->redirect();
    }

    public function loginFacebookCallback()
    {
        try {
            $user = $this->socialite->with('facebook')->user();
            $input = [
                'email' => $user->email,
                'password' => '0',
                'role_id' => 1
            ];
            if (Auth::attempt($input)) {
                alert()->success('Đăng nhập thành công');
                $url = redirect()
                    ->route('home')
                    ->getTargetUrl();
                return redirect($url);
            } else {
                $create = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => '0',
                    'social_id' => $user->id,
                    'type_social' => 'Facebook',
                    'role_id' => 1,
                ];
                User::create($create);

                alert()->success('Đăng nhập thành công!');
                return redirect()->route('home');
            }
        } catch (Exception $e) {
            return redirect('/');
        }
    }
}
