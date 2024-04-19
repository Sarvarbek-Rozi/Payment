<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Currency;
use Illuminate\Support\Facades\Http;

class CurrencyRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Currency();
    }

    public function getQuery()
    {
        return $this->model->query();

    }

    public function store()
    {
        $names = Http::get('openexchangerates.org/api/currencies.json?prettyprint=false&show_alternative=false&show_inactive=false&app_id=1 ')->json();
        $currens=collect($names);
        foreach ($currens as $key => $curren){
            $currency = Currency::create([
                'name'=>$key,
                'currency_name'=>$curren
            ]);
        }

        $data['currency'] = $currency;


        return $data;
    }

}
