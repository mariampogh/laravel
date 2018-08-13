<?php

namespace Laravel\Repositories;

use Laravel\Contract\UserCvContract;

use Laravel\UserCv;



class UserCvRepository implements UserCvContract  
{
	
	private $model;

    public function __construct(UserCv $model)
    {
        $this->model = $model;
    }

    public function create($user_id, $question , $answear)
    {
        return $this->model->create([
                    'user_id' => $user_id,
                    'question' => $question,
                    'answear' => $answear,
                ]);
    }

    public function delete($id)
    {
        $this->getById($id)->delete();
        return true;
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function createCvReturnCountAnswears($user_id,array $input){
        $count = (count($input) -1 )/2;
        $countAnswears = 0;
        for($i = 0; $i < $count; $i++ ){
            $question = "question".$i;
            $answear = "answear".$i;
            if(!is_null($input[$answear])){
                $this->create($user_id,$input[$question],$input[$answear]);
                $countAnswears++;
            }
        }
        
        return $countAnswears;
    }

    public function editCvAndReturnDeletedItemsCount($user_id, $request, $count){
        $deletedItems = 0;
        for($i = 0; $i < $count; $i++ ){
            $question = "question".$i;
            $answear = "answear".$i;
            $userCvItem = $this->model->where([
                                ['user_id', $user_id],
                                ['question', $request->$question],
                                
                            ]) ->first();
            if(!is_null($request->$answear)){
                $userCvItem->answear = $request->$answear;
                $userCvItem->save();
            }
            else{
                $this->delete($userCvItem->id);
                $deletedItems++;
            }
        }
        return $deletedItems;
    }

}