<?php

namespace App\Repositories;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function getQuery()
    {
        return $this->model->query();
    }
    public function getAuth(){
        return Auth::user();
    }
    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function store($request)
    {
//        $confirm_password='';
        if ($request->password==$request->confirm_password){
            $user = $this->model->create([
                'name' => $request->name,
                'phone'=>$request->phone,
                'password'=>Hash::make($request->password),
                'confirm_password'=>Hash::make($request->confirm_password),
                'login_last_date'=>Carbon::now()->format('Y-m-d')
            ]);
        }
        else{
            return "Parol mos emas";
        }
        if (isset($request->permissions))
        {
            $user->perms()->sync($request->permissions);
        }
        $data['user'] = $user;
        return $data;
    }

    public function toValidate($array, $status = null)
    {
        $rules = [
            'name' => 'required', 'string', 'max:255',
            'phone'=>'required','unique',
            'password'=>'required','min:6',
//            'confirm_password' => 'required','min:6',

        ];
        $validator = Validator::make($array, $rules);


        return $validator;
    }

    public function update($request, $id)
    {
        $user = User::find($id);
        if ($request->password==$request->confirm_password) {
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => $request->password,
//                'confirm_password' => $request->confirm_password
            ]);
            $userShow  = User::query()->where('id',$user->id);
            $data['user']=$userShow;
            return $data;
        }
        else{
            return "Parol mos emas";
        }

    }


}
