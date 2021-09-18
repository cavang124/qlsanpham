<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\DetailOrder;
class DashboardController extends Controller
{
    public function index(){
        $total_money = Order::sum('total_money');
        $order = Order::count();
        $product = Product::count();
        
        $hot = Product::leftJoin('detail_order','products.id','=','detail_order.product_id')
            ->selectRaw('products.*, sum(detail_order.number) as total')
            // ->groupBy('detail_order.product_id')
            ->orderBy('total', 'desc')
            ->take(3)->get();        
        return view('include.admin.dashboard.index', compact('total_money', 'order', 'product', 'hot'));
    }
}
