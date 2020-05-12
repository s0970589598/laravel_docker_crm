<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Config;

class SalesModel extends Model
{
    protected $table = 'sales';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'quantity', 'date_of_payment', 'product_id', 'price', 'created_at', 'admin_id', 'discount', 'discount_shop_amt', 'product_type', 'is_active', 'order_status', 'pre_order', 'payment_status','payment_order_no', 'sum_amt', 'shipping_status', 'pickup_time', 'client_level', 'client_phone', 'client_email', 'client_sex', 'client_birthday', 'client_id', 'order_no', 'product_name'
    ];


    public function products()
    {
        return $this->belongsTo(ProductsModel::class, 'product_id');
    }

    public function storeSale(array $requestedData, int $adminId) : int
    {
        return $this->insertGetId(
            [
                'order_no' => $requestedData['order_no'],
                'product_name' => $requestedData['product_name'],
                'quantity' => $requestedData['quantity'],
                'name' => $requestedData['name'],
                'quantity' => $requestedData['quantity'],
                'date_of_payment' => $requestedData['date_of_payment'],
                'product_id' => $requestedData['product_id'],
                'price' => $requestedData['price'],
                'created_at' => $requestedData['created_at'],
                'admin_id' => $requestedData['admin_id'],
                'discount' => $requestedData['discount'],
                'discount_shop_amt' => $requestedData['discount_shop_amt'],
                'product_type' => $requestedData['product_type'],
                'is_active' => $requestedData['is_active'],
                'order_status' => $requestedData['order_status'],
                'pre_order' => $requestedData['pre_order'],
                'payment_status' => $requestedData['payment_status'],
                'payment_order_no' => $requestedData['payment_order_no'],
                'sum_amt' => $requestedData['sum_amt'],
                'utm_source' => $requestedData['utm_source'],
                'shipping_status' => $requestedData['shipping_status'],
                'pickup_time' => $requestedData['pickup_time'],
                'client_level' => $requestedData['client_level'],
                'client_phone' => $requestedData['client_phone'],
                'client_email' => $requestedData['client_email'],
                'client_sex' => $requestedData['client_sex'],
                'client_birthday' => $requestedData['client_birthday'],
                'client_id' => $requestedData['client_id']
             ]);

    }

    public function updateSale(int $saleId, array $requestedData) : int
    {
        return $this->where('id', '=', $saleId)->update(
            [
                'name' => $requestedData['name'],
                'quantity' => $requestedData['quantity'],
                'date_of_payment' => $requestedData['date_of_payment'],
                'product_id' => $requestedData['product_id'],
                'price' => $requestedData['price'],
                'updated_at' => Carbon::now()
            ]);
    }

    public function setActive(int $saleId, int $activeType) : int
    {
        return $this->where('id', '=', $saleId)->update(['is_active' => $activeType]);
    }

    public function countSales() : int
    {
        return $this->all()->count();
    }

    public function getPaginate()
    {
        return $this->paginate(Config::get('crm_settings.pagination_size'));
    }

    public function getSalesSortedByCreatedAt()
    {
        return $this->all()->sortBy('created_at');
    }

    public function getSale(int $saleId) : self
    {
        return $this->find($saleId);
    }
}
