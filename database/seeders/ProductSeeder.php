<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([

            ['user_id' => 1,  'name' => 'Laptop', 'description' => 'Acer', 'price' => 300, 'image' => 'No Image'],
            ['user_id' => 2,  'name' => 'Computer', 'description' => 'Toshiba', 'price' => 500, 'image' => 'No Image'],


        ]);
    }
}
