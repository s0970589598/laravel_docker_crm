<?php

namespace App\Models;

use Carbon\Carbon;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Config;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ClientsModel extends Model
{
    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'phone', 'email', 'section', 'budget', 'location', 'zip', 'city', 'country', 'is_active', 'admin_id', 'birthday', 'cumulative_spend_amt', 'last_shopping_time','level', 'delivered_amt', 'refund_amt', 'used_amt', 'existing_amt', 'membership', 'offer_info', 'period_time'
    ];

    public function companies()
    {
        return $this->hasMany(CompaniesModel::class, 'id');
    }

    public function employees()
    {
        return $this->hasMany(EmployeesModel::class, 'id');
    }

    public function storeClient(array $requestedData, int $adminId) : int
    {
        return $this->insertGetId(
            [
                'full_name' => $requestedData['full_name'],
                'phone' => $requestedData['phone'],
                'email' => $requestedData['email'],
                'section' => $requestedData['section'],
                'budget' => $requestedData['budget'],
                'location' => $requestedData['location'],
                'zip' => $requestedData['zip'],
                'city' => $requestedData['city'],
                'country' => $requestedData['country'],
                'created_at' => Carbon::now(),
                'is_active' => 1,
                'birthday' => $requestedData['birthday'],
                'cumulative_spend_amt' => $requestedData['cumulative_spend_amt'],
                'last_shopping_time' => $requestedData['last_shopping_time'],
                'level' => $requestedData['level'],
                'delivered_amt' => $requestedData['delivered_amt'],
                'refund_amt' => $requestedData['refund_amt'],
                'used_amt' => $requestedData['used_amt'],
                'existing_amt' => $requestedData['existing_amt'],
                'membership' => $requestedData['membership'],
                'offer_info' => $requestedData['offer_info'],
                'period_time' => $requestedData['period_time'],
                'admin_id' => $adminId
            ]
        );
    }


    public function updateClient(int $id, array $requestedData) : int
    {
        return $this->where('id', '=', $id)->update(
            [
                'full_name' => $requestedData['full_name'],
                'phone' => $requestedData['phone'],
                'email' => $requestedData['email'],
                'section' => $requestedData['section'],
                'budget' => $requestedData['budget'],
                'location' => $requestedData['location'],
                'zip' => $requestedData['zip'],
                'city' => $requestedData['city'],
                'country' => $requestedData['country'],
                'level' => $requestedData['level'],
                'birthday' => $requestedData['birthday'],
                'updated_at' => Carbon::now()
            ]);
    }

    public function setClientActive(int $id, int $activeType) : int
    {
        return $this->where('id', '=', $id)->update(['is_active' => $activeType]);
    }

    public function countClients() : int
    {
        return $this->all()->count();
    }

    public static function getClientsInLatestMonth() : float
    {
        $clientCount = self::where('created_at', '>=', Carbon::now()->subMonth())->count();
        $allClient = self::all()->count();

        $new_width = ($allClient / 100) * $clientCount;

        return $new_width;
    }

    public function getDeactivated() : int
    {
        return $this->where('is_active', '=', 0)->count();
    }

    public function getClientByGivenClientId(int $clientId) : self
    {
        $query = $this->find($clientId);

        if(is_null($query)) {
            throw new BadRequestHttpException('User with given clientId not exists.');
        }

        Arr::add($query, 'companiesCount', count($query->companies));
        Arr::add($query, 'employeesCount', count($query->employees));
        //Arr::add($query, 'formattedBudget', Money::{SettingsModel::getSettingValue('currency')}($query->budget));
        Arr::add($query, 'formattedBudget', ($query->budget));

        return $query;
    }

    public function getClientSortedBy()
    {
        $query = $this->all()->sortBy('created_at');

        foreach($query as $key => $client) {
            //$query[$key]->budget = Money::{SettingsModel::getSettingValue('currency')}($client->budget);
            $query[$key]->budget = ($client->budget);
        }

        return $query;
    }

    public function getPaginate()
    {
        return $this->paginate(Config::get('crm_settings.pagination_size'));
    }
}
