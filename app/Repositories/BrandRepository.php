<?php

namespace App\Repositories;
use App\Models\Brand;

use Illuminate\Support\Facades\Validator;

class BrandRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Brand();
    }

    public function getQuery()
    {
        return $this->model->query();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function store($request)
    {
        $user = auth()->user();
        $path=null;
        if($request->hasFile('photo')){

            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('brand-photos',$name,'public');
//            $file = $request->file('photo');
//            $result = Storage::disk('public')->put('brand-photos', $file);
        }
        $brand = Brand::create([
            'name'=>$request->name,
            'photo' =>$path,
            'user_id'=>$user->id
        ]);
        $data['brand'] = $brand;
        return $data;
    }



    public function toValidate($array, $status = null)
    {
        $rules = [
            'name' => 'required', 'string', 'max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ];
        $validator = Validator::make($array, $rules);
        return $validator;
    }

    public function update($request, $id )
    {
        $brand = Brand::find($id);

        $path=null;
//        if($request->hasFile('photo')){
//            $name = $request->file('photo')->getClientOriginalName();
//            $path = $request->file('photo')->storeAs('brand-photos',$name,'public');
//
//        }
        $brand -> update([
            'name' => $request->name,
            'photo' => $path
        ]);
            $brandShow  = Brand::query()->where('id',$brand->id);
            $data['brand']=$brandShow;
            return $data;


    }


}
