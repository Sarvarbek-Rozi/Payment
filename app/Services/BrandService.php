<?php


namespace App\Services;

use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;


class BrandService
{

    private $repository;

    public function __construct()
    {
        $this->repository = new BrandRepository();
    }

    public function getAll(Request $request)
    {
        $query = $this->repository->getQuery();

        if (!empty($request->get['name'])) {
            $query->where('brands.name', 'like', '%' . $request->get['name'] . '%');
        }
        if ($request->get('getAll')) {
            return $query->get();
        }
        return $query->paginate(15);
    }
    public function store($request)
    {

        $validator = $this->repository->toValidate($request->all());
        $msg = "";
        if (!$validator->fails()) {
            $brand = $this->repository->store($request);
            return response()->json($brand);
        } else {
            $errors = $validator->failed();
            if (!empty($errors)) {
                $msg = "Brand yaratilmadi";
            }
            return response()->json($msg, 400);
        }
    }

    public function show($id)
    {
        $query = Brand::query();
        $query->where(['id' => $id]);


        if (empty($query->first())){
            return response()->errorJson('Бундай ид ли brand мавжуд емас', 409);
        }
        else{
            return $query->first();
        }

    }

    public function update($request, $id){
        $msg = "";
        $validator = $this->repository->toValidate($request->all());

        if (!$validator->fails()) {
            $brand = $this->repository->update($request,$id);
            $result =  ['status' => 200, 'brand' => $brand];
        } else {
            $errors = $validator->failed();
            if(empty($errors)) {
                $msg = "нотўғри киритилди";
            }
            $result = ['msg' => $msg, 'status' => 422, 'error' => $errors];
        }

        if($result['status'] == 409) {
            return response()->errorJson($result['msg'], 200, [], [], 'db');
        }
        if($result['status'] == 422) {
            return response()->errorJson($result['msg'], 200, $result['error'], [], 'db');
        }
        return response()->successJson($result['brand']);
    }
    public function destroy($id){
        $brand = $this->repository->getById($id);
        if ($brand){
            $brand->delete();
            $this->response['success'] = true;
        }

        else {
            $this->response['success'] = false;
            $this->response['error'] = "Brand not found";
        }
        return response()->json($this->response);
    }
}
