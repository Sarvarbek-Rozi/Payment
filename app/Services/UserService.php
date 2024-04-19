<?php


namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;

class UserService
{

    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function getAll(Request $request)
    {
        $query = $this->repository->getQuery();

        if (!empty($request->get['name'])) {
            $query->where('users.name', 'like', '%' . $request->get['name'] . '%');
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
            $user = $this->repository->store($request);
            return response()->json($user);
        } else {
            $errors = $validator->failed();
            if (!empty($errors)) {
                $msg = "Foydalanuvchi yaratilmadi";
            }
            return response()->json($msg, 400);
        }
    }

    public function show($id)
    {
//        $user = Auth::user();
        $query = User::query();
        $query->where(['id' => $id]);


        if (empty($query->first())){
            return response()->errorJson('Бундай ид ли фойдаланувчи мавжуд емас', 409);
        }
        else{
            return $query->first();
        }

        }

    public function update($request, $id){
        $msg = "";
        $validator = $this->repository->toValidate($request->all());

        if (!$validator->fails()) {
            $user = $this->repository->update($request, $id);
            $result =  ['status' => 200, 'user' => $user];
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
        return response()->successJson($result['user']);
    }
    public function destroy($id){
        $user = $this->repository->getById($id);
        if ($user){
            $user->delete();
            $this->response['success'] = true;
        }

        else {
            $this->response['success'] = false;
            $this->response['error'] = "User not found";
        }
        return response()->json($this->response);
    }
}
