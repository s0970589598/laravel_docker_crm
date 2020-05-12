<?php

namespace App\Imports;

use App\Models\SalesModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Arr;

class SalesImport implements ToModel, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new SalesModel([

            'order_no' => Arr::get($row, 'order_no', ''),
            'date_of_payment' => Arr::get($row, 'date_of_payment', ''),
            'order_status' => Arr::get($row, 'order_status', ''),
            'pre_order' => Arr::get($row, 'pre_order', ''),
            'payment_status' => Arr::get($row, 'payment_status', ''),
            'payment_order_no' => Arr::get($row, 'payment_order_no', ''),
            'price' => Arr::get($row, 'price', ''),
            'discount' => Arr::get($row, 'discount', ''),
            'discount_shop_amt' => Arr::get($row, 'discount_shop_amt', ''),
            'sum_amt' => Arr::get($row, 'sum_amt', ''),
            'product_name' => Arr::get($row, 'product_name', ''),
            'quantity' => Arr::get($row, 'quantity', ''),
            'product_type' => Arr::get($row, 'product_type', ''),
            'product_id' => Arr::get($row, 'product_id', ''),
            'utm_source' => Arr::get($row, 'utm_source', 1),
            'shipping_status' => Arr::get($row, 'shipping_status', 0),
            'pickup_time' => Arr::get($row, 'pickup_time', 0),
            'client_level' => Arr::get($row, 'client_level', ''),
            'client_phone' => Arr::get($row, 'client_phone', ''),
            'client_email' => Arr::get($row, 'client_email', ''),
            'client_sex' => Arr::get($row, 'client_sex', 1),
            'client_birthday' => Arr::get($row, 'client_birthday', ''),
            'client_id' => Arr::get($row, 'client_id', 1),
            'admin_id' => Arr::get($row, 'admin_id', 1),
            'name' => Arr::get($row, 'name', ''),
            'is_active' => Arr::get($row, 'is_active', 1)
        ]);

    }



}
