<?php


namespace App\Services;

use App\Models\Branch;
use App\Repositories\BranchRepository;
use Illuminate\Http\Request;


class BranchService
{

    private $repository;

    public function __construct()
    {
        $this->repository = new BranchRepository();
    }

    public function getAll(Request $request)
    {
        $query = $this->repository->getQuery();

        if (!empty($request->get['name'])) {
            $query->where('branches.name', 'like', '%' . $request->get['name'] . '%');
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
                $msg = "Branch yaratilmadi";
            }
            return response()->json($msg, 400);
        }
    }

    public function show($id)
    {
        $query = Branch::query();
        $query->where(['id' => $id]);
        if (empty($query->first())){
            return response()->errorJson('Бундай ид ли branch мавжуд емас', 409);
        }
        else{
            return $query->first();
        }

    }

    public function update($request, $id){
        $msg = "";
        $validator = $this->repository->toValidate($request->all());

        if (!$validator->fails()) {
            $branch = $this->repository->update($request,$id);
            $result =  ['status' => 200, 'branch' => $branch];
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
        $branch = $this->repository->getById($id);
        if ($branch){
            $branch->delete();
            $this->response['success'] = true;
        }

        else {
            $this->response['success'] = false;
            $this->response['error'] = "Brand not found";
        }
        return response()->json($this->response);
    }
}
