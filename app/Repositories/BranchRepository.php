<?php

namespace App\Repositories;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\City;
use Illuminate\Support\Facades\Validator;

class BranchRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Branch();
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
        $images='';
        if($request->hasFile('photo'))
        {
            $names = [];
            foreach($request->file('photo') as $image)
            {
                $filename = $image->getClientOriginalName();
                $path = $image->storeAs('content_images',$filename,'public');

                array_push($names, $path);

            }
            $images = json_encode($names);
        }
        $CityShow  = City::query()->where('id',$request->city_id);
        if($CityShow->first()->region_id==$request->region_id){
            $branch = Branch::create([
                'name'=>$request->name,
                'photo'=>  $images,
                'brand_id'=>$request->brand_id,
                'region_id'=>$request->region_id,
                'city_id'=>$request->city_id

            ]);
            $data['branch'] = $branch;
            return $data;
        }
        else{
            return "Error";
        }
    }

    public function toValidate($array, $status = null)
    {
        $rules = [
            'name' => 'required', 'string', 'max:255',
//            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'brand_id'=>'required|exists:brands,id',
            'region_id'=>'required|exists:regions,id',
            'city_id'=>'required|exists:cities,id'
        ];
        $validator = Validator::make($array, $rules);
        return $validator;
    }

    public function update($request, $id )
    {
        $branch = Branch::find($id);
        $images='';
        if($request->hasFile('photo'))
        {
            $names = [];
            foreach($request->file('photo') as $image)
            {
                $filename = $image->getClientOriginalName();
                $path = $image->storeAs('content_images',$filename,'public');
                array_push($names, $path);

            }
            $images = json_encode($names);
        }
        $branch -> update([
            'name' => $request->name,
            'photo' => $images,
            'brand_id'=>$request->brand_id,
            'region_id'=>$request->region_id,
            'city_id'=>$request->city_id
        ]);
        $branchShow  = Branch::query()->where('id',$branch->id);
        $data['branch']=$branchShow;
        return $data;
    }


}
