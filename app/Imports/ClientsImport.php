<?php

namespace App\Imports;

use App\Models\ClientsModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Arr;

class ClientsImport implements ToModel, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ClientsModel([
            'full_name' => Arr::get($row, 'full_name', ''),
            'phone' => Arr::get($row, 'phone', ''),
            'location' => Arr::get($row, 'location', ''),
            'birthday' => Arr::get($row, 'birthday', ''),
            'email' => Arr::get($row, 'email', ''),
            'cumulative_spend_amt' => Arr::get($row, 'cumulative_spend_amt', 0),
            'last_shopping_time' => Arr::get($row, 'last_shopping_time', ''),
            'level' => Arr::get($row, 'level', ''),
            'delivered_amt' => Arr::get($row, 'delivered_amt', ''),
            'refund_amt' => Arr::get($row, 'refund_amt', ''),
            'used_amt' => Arr::get($row, 'used_amt', ''),
            'existing_amt' => Arr::get($row, 'existing_amt', ''),
            'membership' => Arr::get($row, 'membership', ''),
            'offer_info' => Arr::get($row, 'offer_info', ''),
            'created_at' => Arr::get($row, 'created_at', ''),
            'period_time' => Arr::get($row, 'period_time', ''),
            'is_active' => Arr::get($row, 'is_active', 1),
            'section' => Arr::get($row, 'section', 0),
            'budget' => Arr::get($row, 'budget', 0),
            'zip' => Arr::get($row, 'zip', ''),
            'city' => Arr::get($row, 'city', ''),
            'country' => Arr::get($row, 'country', ''),
            'admin_id' => Arr::get($row, 'admin_id', 1),

        ]);
    }



}
