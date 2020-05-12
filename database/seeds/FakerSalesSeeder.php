<?php

use Illuminate\Database\Seeder;

class FakerSalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
//        $productDetails = \App\Models\ProductsModel::where('id', '=', $productId)->get();
        $productDetails = \App\Models\ProductsModel::all();

            foreach($productDetails as $detail) {
                $sales = [
                    'name' => $faker->name,
                    'quantity' => rand(10,20),
                    'product_id' => $detail->id,
                    'order_no' => 'no' . rand(10,20),
                    'product_name' => '234',
                    'date_of_payment' => $faker->dateTimeThisMonth(),
                    'price' => $detail->price, //update this manual
                    'created_at' => $faker->dateTimeBetween($startDate = '-30 days', $endDate = 'now'),
                    'updated_at' => \Carbon\Carbon::now(),
                    'admin_id' => 1,
                    'order_status' => '',
                    'pre_order' => '',
                    'payment_status' => '',
                    'payment_order_no' => 'p' . rand(10,20),
                    'discount' => 0,
                    'discount_shop_amt' => 0,
                    'product_type' => '',
                    'utm_source' => '',
                    'shipping_status' => '',
                    'pickup_time' => $faker->dateTimeBetween($startDate = '-1 days', $endDate = 'now'),
                    'client_level' => '',
                    'client_phone' => '',
                    'client_email' =>'',
                    'client_sex' => \Carbon\Carbon::now(),
                    'client_birthday' => '',
                    'client_id' => 1
                ];
                $sales['sum_amt'] = $sales['price'] * $sales['quantity'];

                DB::table('sales')->insert($sales);
            }
        }
}
