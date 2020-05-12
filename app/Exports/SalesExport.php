<?php

namespace App\Exports;

use App\Models\SalesModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SalesExport implements FromCollection, WithHeadings, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $sales = SalesModel::all();


       //return ClientsModel::select(['full_name', 'phone', 'email', 'section', 'budget', 'location', 'zip', 'city', 'country', 'is_active', 'admin_id'])
       //->get();

       //return ClientsModel::select(['full_name', 'phone'])
       //->where('full_name', 'Monserrat Wyman')
       //->get();

       return $array = $sales->map(function ($value, $key) {
            return [
                'order_no' => 'test' . $value->order_no,
                'date_of_payment' => $value->date_of_payment,
                'order_status' => $value->order_status,
                'pre_order' => $value->pre_order,
                'payment_status' => $value->payment_status,
                'payment_order_no' => $value->payment_order_no,
                'price' => $value->price,
                'discount' => $value->discount,
                'discount_shop_amt' => $value->discount_shop_amt,
                'sum_amt' => $value->sum_amt,
                'product_name' => $value->product_name,
                'quantity' => $value->quantity,
                'product_type' => $value->product_type,
                'product_id' => $value->product_id,
                'utm_source' => $value->utm_source,
                'shipping_status' => $value->shipping_status,
                'pickup_time' => $value->pickup_time,
                'client_level' => $value->client_level,
                'client_phone' => $value->client_phone,
                'client_email' => $value->client_email,
                'client_sex' => $value->client_sex,
                'client_birthday' => $value->client_birthday,
                'client_id' => $value->client_id,
            ];
        });
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Month';
    }
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'order_no',
            'date_of_payment',
            'order_status',
            'pre_order',
            'payment_status',
            'payment_order_no',
            'price',
            'discount',
            'discount_shop_amt',
            'sum_amt',
            'product_name',
            'quantity',
            'product_type',
            'product_id',
            'utm_source',
            'shipping_status',
            'pickup_time',
            'client_level',
            'client_phone',
            'client_email',
            'client_sex',
            'client_birthday',
            'client_id'
        ];
    }


}
