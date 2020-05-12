<?php

namespace App\Exports;

use App\Models\ClientsModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ClientsExport implements FromCollection, WithHeadings, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $clients = ClientsModel::all();


       //return ClientsModel::select(['full_name', 'phone', 'email', 'section', 'budget', 'location', 'zip', 'city', 'country', 'is_active', 'admin_id'])
       //->get();

       //return ClientsModel::select(['full_name', 'phone'])
       //->where('full_name', 'Monserrat Wyman')
       //->get();

       return $array = $clients->map(function ($value, $key) {
            return [
                'full_name' => 'test' . $value->full_name,
                'phone' => $value->phone,
                'location' => $value->location,
                'birthday' => $value->birthday,
                'email' => 'test' . $value->email,
                'cumulative_spend_amt' => $value->cumulative_spend_amt,
                'last_shopping_time' => $value->last_shopping_time,
                'level' => $value->level,
                'delivered_amt' => $value->delivered_amt,
                'refund_amt' => $value->refund_amt,
                'used_amt' => $value->used_amt,
                'existing_amt' => $value->existing_amt,
                'membership' => $value->membership,
                'offer_info' => $value->offer_info,
                'created_at' => $value->created_at,
                'period_time' => $value->period_time,
            ];
        });

       return $clients->filter(function ($value) {
            return $value['full_name'] == 'Monserrat Wyman'
                || $value['phone'] == '396.946.4661';
        })
            ->map(function ($value, $key) use ($clients) {

                return [
                    'full_name' => 'test' . $value->full_name,
                    'phone' => $value->phone,
                    'location' => $value->location,
                    'birthday' => $value->birthday,
                    'email' => 'test' . $value->email,
                    'cumulative_spend_amt' => $value->cumulative_spend_amt,
                    'last_shopping_time' => $value->last_shopping_time,
                    'level' => $value->level,
                    'delivered_amt' => $value->delivered_amt,
                    'refund_amt' => $value->refund_amt,
                    'used_amt' => $value->used_amt,
                    'existing_amt' => $value->existing_amt,
                    'membership' => $value->membership,
                    'offer_info' => $value->offer_info,
                    'created_at' => $value->created_at,
                    'period_time' => $value->period_time,
                    'is_active' => 1,
                    'admin_id' => 1,
                    'section' => 0,
                    'budget' => 0,
                    'zip' => '',
                    'city' => '',
                    'country' => '',

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
            'full_name',
            'phone',
            'location',
            'birthday',
            'email',
            'cumulative_spend_amt',
            'last_shopping_time',
            'level' ,
            'delivered_amt' ,
            'refund_amt',
            'used_amt',
            'existing_amt',
            'membership',
            'offer_info',
            'created_at',
            'period_time',
        ];
    }


}
