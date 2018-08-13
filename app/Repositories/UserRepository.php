<?php

namespace Laravel\Repositories;

use Hash; 
use Laravel\User; 
use Laravel\Profession; 
use Laravel\Contract\UserContract;

class UserRepository implements UserContract  
{
	
	private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function index($id){
    	$checkCv = $this->checkCv($id);
    	if($checkCv){
    		return ["type" => "cv", "data" => $this->getUserCV($id)];
    	}
    	return ["type" => "profession","data" =>  Profession::all()];
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function delete($id)
    {
         $this->model->with('userCv')->find($id)->delete();
        return true;
    }

	public function checkCv($id)
	{
		return $this->model->find($id)->cv;
	}
	public function getUserCV($id){
    	return $this->model->with('userCv')->find($id);
    }

    public function changeUserCvColumn($user_id, $value){
        $getUser = $this->getById($user_id);
        $getUser->update(['cv' => $value]);
        return $getUser;
    }

    public function editInfo($user_id, $request){
        $user = $this->getById($user_id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return $user;
    }

    public function changePwd($user_id,$password){
        $user = $this->getById($user_id);
        $user->update(['password' => Hash::make($password)]);
        return $user;
    }
    public function create($request)
    {
        $user = $this->model->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $user;
    }

}