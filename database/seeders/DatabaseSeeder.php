<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\DetailOrder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $newUser = [
            'name' => 'Ngọc Bích',
            'phone' => '0397867872',
            'email' => 'ngocbich@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => 1,
        ];
        User::create($newUser);

        $newCategory = [
            'title' => 'Hoa quả',
        ];
        Category::create($newCategory);

        $newProduct = [
            'code' => 'MF9123',
            'name' => 'Dưa hấu',
            'image' => '',
            'category_id' => '1',
            'price' => '30000'
        ];
        Product::create($newProduct);

        $newOrder = [
            'code' => 'ĐH001',
            'total_product' => 1,
            'total_money' => 35000,
            'user_id' => 1,
            'address_order' => 'Thái Bình',
            'ship' => 5000
        ];
        Order::create($newOrder);

        $detailOrder = [
            'order_id' => 1,
            'product_id' => 1,
            'price' => 30000,
            'number' => 1
        ];
        DetailOrder::create($detailOrder);


    }
}
