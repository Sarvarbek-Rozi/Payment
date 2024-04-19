<?php


namespace App\Services;

use App\Repositories\CurrencyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class CurrencyService
{

    private $repository;

    public function __construct()
    {
        $this->repository = new CurrencyRepository();
    }

    public function getAll(Request $request)
    {
        $query = $this->repository->getQuery();

        if ($request->get('getAll')) {
            return $query->get();
        }
        return $query->paginate(170);
    }
    public function store($request)
    {
         $brand = $this->repository->store();
            return response()->json($brand);
        }

}
