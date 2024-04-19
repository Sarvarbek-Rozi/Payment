<?php

namespace App\Http\Controllers;
use App\Repositories\CurrencyRepository;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class CurrencyController extends Controller
{
    private $service;
    public function __construct()
    {
        $this->service = new CurrencyService();
        $this->repo = new CurrencyRepository();


    }
//    public function index()
//    {
//        $response = Http::get('openexchangerates.org/api/currencies.json?prettyprint=false&show_alternative=false&show_inactive=false&app_id=1 ');
//        $jsonData =$response->json();
//        dd($jsonData);
//    }
    public function index(Request $request)
    {
        $branches = $this->service->getAll($request);
        return response()->successJson(['branches' => $branches]);
    }
    public function store(Request $request)
    {
        return $this->service->store($request);
    }
}
