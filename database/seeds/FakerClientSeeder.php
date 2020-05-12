<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Mockery\Expectation;

class FakerClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $section = ['transport', 'logistic', 'finances'];
            for ($i = 0; $i<=30; $i++) {
                $client = [
                    'full_name' => $faker->name,
                    'phone' => $faker->phoneNumber,
                    'email' => $faker->phoneNumber . '@' . $faker->safeEmailDomain,
                    'section' => Arr::random($section),
                    'budget' => rand(100, 1000),
                    'location' => $faker->country,
                    'zip' => $faker->postcode,
                    'city' => $faker->city,
                    'country' => $faker->country,
                    'birthday' => $faker->date,
                    'cumulative_spend_amt' => 0,
                    'last_shopping_time' => $faker->dateTimeBetween($startDate = '-30 days', $endDate = 'now'),
                    'level' => 0,
                    'delivered_amt' => 0,
                    'refund_amt' => 0,
                    'used_amt' => 0,
                    'existing_amt' => 0,
                    'membership' => '',
                    'offer_info' => '',
                    'period_time' => $faker->dateTimeBetween($startDate = '-30 days', $endDate = 'now'),
                    'created_at' => $faker->dateTimeBetween($startDate = '-30 days', $endDate = 'now'),
                    'updated_at' => \Carbon\Carbon::now(),
                    'admin_id' => 1
                ];
                 DB::table('clients')->insert($client);
            }

    }
}
