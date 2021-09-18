<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\DetailOrder;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = [];
        if ($request->code) {
            $where[] = ['code', 'like', '%' . $request->code . '%'];
        }
        if ($request->status) {
            $where[] = ['status', $request->status];
        }

        $listOrder = Order::where($where)
            ->orderby('id', 'desc')
            ->with('detail', 'user')
            ->paginate(6);
        $product = Product::get();
        return view('include.admin.order.index', compact('listOrder', 'product'));
    }

    public function create()
    {
        $allProduct = Product::get();
        $allUser = User::whereRoleId('2')->get();
        return view('include.admin.order.create', compact('allProduct', 'allUser'));
    }

    public function detail($id)
    {
        $infor = Order::findorfail($id)->load('detail', 'detail.product', 'user');
        return view('include.admin.order.detail', compact('infor'));
    }

    public function store(Request $request)
    {
        // try {
        $validator = Validator::make(
            $request->all(),
            [
                'code' => 'required|unique:order',
                'address_order' => 'required',
                'user_id' => 'required',
            ],
            [
                'code.required' => 'Vui lòng nhập mã đơn hàng',
                'code.unique' => 'Mã đơn hàng đã tồn tại',
                'address_order.required' => 'Vui lòng nhập địa chỉ giao hàng.',
                'user_id.required' => 'Vui lòng chọn khách hàng.',
            ],
        );
        if ($validator->fails()) {
            alert()->warning($validator->getMessageBag()->first());
            return redirect()->back();
        }

        $user = User::findorfail($request->user_id);
        if ($user) {
            $total_product = 0;
            $total_money = 0;
            $number = $request->number;

            foreach ($request->product as $index => $item) {
                $product = Product::findorfail($item);
                $total_product += $number[$index];
                $total_money += $product['price'] * $number[$index];
            }
            $body = [
                'code' => $request->code,
                'user_id' => $user['id'],
                'address_order' => $request->address_order,
                'total_product' => $total_product,
                'total_money' => $total_money,
                'status' => 1,
                'ship' => 0,
            ];

            DB::beginTransaction();
            try {
                $order = Order::create($body);

                foreach ($request->product as $key => $item) {
                    $product = Product::find($item);
                    if ($number[$key] > $product['number']) {
                        alert()->warning('Số lượng sản phẩm không đủ!');
                        return redirect()->back();
                    } else {
                        $detail = [
                            'order_id' => $order['id'],
                            'product_id' => $item,
                            'number' => $number[$key],
                            'price' => $product['price'],
                        ];
                        DetailOrder::create($detail);
                        $req['number'] = $product['number'] - $number[$key];
                        if ($req['number'] == 0) {
                            $req['status'] = 2;
                        }

                        $product->update($req);
                    }
                }

                DB::commit();
                alert()->success('Đặt hàng thành công!');
                return redirect()->back();
            } catch (Exception $e) {
                DB::rollBack();
                alert()->warning('Đặt hàng không thành công!');
                return redirect()->back();
                throw new Exception($e->getMessage());
            }
        }
        // } catch (\Throwable $th) {
        //     //throw $th;

        // }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'status' => 'required',
            ],
            [
                'status.required' => 'Vui lòng chọn trạng thái đơn hàng',
            ],
        );

        if ($validator->fails()) {
            alert()->warning($validator->getMessageBag()->first());
            return redirect()->back();
        }

        $req = $request->all();
        $data = Order::findorfail($id);
        $detailOrder = DetailOrder::whereOrderId($id)->get();
       
        DB::beginTransaction();
        try {
            if ($request['status'] == 5) {
                foreach ($detailOrder as $key => $value) {
                   
                    $product = Product::find($value['product_id']);
                 
                    $update['number'] = $product['number'] + $value['number'];
                  
                    if ($product['status'] == 2) {
                        $update['status'] = 1;
                    }
                   
                    $product->update($update);
                }
            }
            $data->update($req);
            DB::commit();
            alert()->success('Cập nhật đơn hàng thành công!');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            alert()->warning('Cập nhật đơn hàng không thành công!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
