<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Repositories\BrandRepository;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    private $service;
    private $repo;
    protected $response;

    public function __construct()
    {
        $this->service = new BrandService();
        $this->repo = new BrandRepository();

    }
    public function index(Request $request)
    {
        $brands = $this->service->getAll($request);
        return response()->successJson(['brands' => $brands]);
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function show($id)
    {
        $brands = $this->service->show($id);
        $this->response['result'] = [
            'brand' =>  $brands
        ];
        return response()->json($this->response);
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request, $id);

    }

    public function destroy($id)
    {
        return $this->service->destroy($id);

    }
}
