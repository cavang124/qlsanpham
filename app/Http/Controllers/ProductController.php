<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Product;
use App\Models\DetailOrder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listProduct = Product::orderby('id', 'desc')
            ->with('category')
            ->paginate(5);
        $category = Category::all();

        return view('include.product.index', compact('listProduct', 'category'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'price' => 'required',
                'code' => 'required|unique:products',
                'category_id' => 'required',
            ],
            [
                'name.required' => 'Vui lòng nhập tên sản phẩm',
                'price.required' => 'Vui lòng nhập giá sản phẩm',
                'code.required' => 'Vui lòng nhập mã code sản phẩm',
                'code.unique' => 'Mã code sản phẩm đã tồn tại',
                'category_id' => 'Vui lòng chọn danh mục',
            ],
        );

        if ($validator->fails()) {
            alert()->warning($validator->getMessageBag()->first());
            return redirect()->back();
        }

        $req = $request->all();
        if ($request->file('image') != null) {
            $req['image'] = $this->uploadImage($request->file('image'));
        }
        $create = Product::create($req);
        $request->session()->flash('success', 'Thêm mới sản phẩm thành công!');
        $url = redirect()
            ->route('product.index')
            ->getTargetUrl();
        return redirect($url);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'price' => 'required',
                'category_id' => 'required',
            ],
            [
                'name.required' => 'Vui lòng nhập tên sản phẩm',
                'price.required' => 'Vui lòng nhập giá sản phẩm',
                'category_id' => 'Vui lòng chọn danh mục',
            ],
        );

        if ($validator->fails()) {
            alert()->warning($validator->getMessageBag()->first());
            return redirect()->back();
        }

        $req = $request->all();
        $data = Product::findorfail($id);

        if ($request->file('image') != null) {
            $req['image'] = $this->uploadImage($request->file('image'));
        }
        $data->update($req);
        alert()->success('Sửa sản phẩm thành công!');
        return redirect()->back();
    }

    public function delete($id)
    {
        $order = DetailOrder::where('product_id', $id)->count();
        if ($order > 0) {
            alert()->error('Sản phẩm đã được đặt hàng nên không thể xoá!');
            return redirect()->back();
        } else {
            $delete = Product::find($id)->delete();
            alert()->success('Xóa sản phẩm thành công!');
            return redirect()->back();
        }
    }
}
