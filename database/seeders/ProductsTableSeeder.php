<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {

        $products = ['IPhone 11', 'IPhone 13'];
        foreach ($products as $product) {
            Product::create([
                'category_id' => 1,
                'name' => $product,
                'description' => $product . ' Description',
                'purchase_price' => 100,
                'sale_price' => 150,
                'stock' => 50,
            ]);
        }
            $TV_products = ['LG Television', 'Samsung Television'];
        foreach ($TV_products as $tv_product){
            Product::create([
                'category_id' => 2,
                'name' => $tv_product,
                'description' => $tv_product . ' Description',
                'purchase_price' => 200,
                'sale_price' => 250,
                'stock' => 20,
            ]);
        }
        $AC_products = ['UnionAir', 'Toshiba'];
        foreach ($AC_products as $ac_product){
            Product::create([
                'category_id' => 3,
                'name' => $ac_product,
                'description' => $ac_product . ' Description',
                'purchase_price' => 1500,
                'sale_price' => 200,
                'stock' => 15,
            ]);
        }
    }
}
