<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Repositories\BranchRepository;
use App\Services\BranchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    private $service;
    private $repo;
    protected $response;

    public function __construct()
    {
        $this->service = new BranchService();
        $this->repo = new BranchRepository();


    }
    public function index(Request $request)
    {
        $branches = $this->service->getAll($request);
        return response()->successJson(['branches' => $branches]);
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function show($id)
    {
        $branches = $this->service->show($id);
        $this->response['result'] = [
            'branch' =>  $branches
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
    public function fullReportbranches(Request $request)
    {
        $branch = DB::table('branches')
            ->leftJoin('brands', 'brands.id', '=', 'branches.brand_id')
            ->leftJoin('cities', 'cities.id', '=', 'branches.city_id')
            ->selectRaw('
            count(1) as soni,
            cities.name as city,
            brands.name as brand
        ');
        if ($request->get('region_id')){
            $branch = $branch->where('region_id',$request->get('region_id'));
        }


        return $branch->groupBy('cities.name','brands.name')->get();

    }

}
