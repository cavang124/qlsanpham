<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
   
    public function index(Request $request)
    {
        $category = Category::get();
        return view('include.admin.category.index', compact('category'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->warning('Vui lòng nhập thông tin đầy đủ!');
            return redirect()->back();
        }
        $req = $request->all();
        $data = Category::create($req);
        alert()->success('Thêm mới danh mục thành công!');
        return redirect()->back();
    }


   
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->warning('Vui lòng nhập thông tin đầy đủ!');
            return redirect()->back();
        }
        $req = $request->all();
        $data = Category::findorfail($id);
        $data->update($req);
        alert()->success('Sửa danh mục thành công!');
        return redirect()->back();
    }

    public function delete($id)
    {
        $product = Product::whereCategoryId($id)->get();
        $delete = Category::where('id', $id)->delete();
        alert()->success('Xóa danh mục thành công!');
        return redirect()->back();
    }
}
