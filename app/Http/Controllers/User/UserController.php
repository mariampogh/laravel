<?php

namespace Laravel\Http\Controllers\User;

use PDF;
use Auth;
use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;
use Laravel\Repositories\UserRepository;
use Laravel\Repositories\UserCvRepository;
use Laravel\Repositories\ProfessionRepository;

class UserController extends Controller
{
    private $userRepo;
    private $userCvRepo;
    private $professionRepo;
	
    public function __construct(UserRepository $userRepo,UserCvRepository $userCvRepo,ProfessionRepository $professionRepo)
    {   
        $this->middleware('authUser');
        $this->userRepo = $userRepo;
        $this->userCvRepo = $userCvRepo;
        $this->professionRepo = $professionRepo;
       
    }

    public function userId(){
        return Auth::id();
    }

    public function index()
    {

        $redirectInfo = $this->userRepo->index($this->userId());
        if ($redirectInfo['type'] == 'cv') {
            return view('user.userCv')->with('cv', $redirectInfo['data']->userCv);
        }
        return view('user.home')->with('professions', $redirectInfo['data']);
    }

    public function cv($id){
        $checkCv = $this->userRepo->checkCv($this->userId());
    	if($checkCv){
    		$cv = $this->userRepo->getUserCV($this->userId());
    		return view('user.userCv')->with('cv', $cv->userCv);
    	}
		$questions = $this->professionRepo->getById($id);
		return view('user.blankCv')->with(['questions' =>  $questions->questions, 'prof_id' => $id]);
    }

    public function createCv(Request $request){
        $countAnswears = $this->userCvRepo->createCvReturnCountAnswears($this->userId(),$request->all());
        if($countAnswears != 0){
            $this->userRepo->changeUserCvColumn($this->userId(), 1);
        }
        return redirect()->route('home');
    }

    public function changeInfoPage(){
        $info = $this->userRepo->getById($this->userId());
        return view('user.changeInfo')->with('info' , $info);
    }

    public function changePwd(Request $request){
        $validator = $this->validate($request,[  
            'password' => 'required|string|min:6|confirmed'
        ]);
        $user = $this->userRepo->changePwd($this->userId(), $request->password);
        return redirect()->back()->with('message','Successfull update!');
    }

    public function editInfo(Request $request){
        $validator = $this->validate($request,[
            'name' => 'required|string|max:255|min:3',
            'address' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->userId()
        ]);
        $user = $this->userRepo->editInfo($this->userId(), $request);
        return redirect()->back()->with('message','Successfull update!');
    }

    public function userCv(){
        $checkCv = $this->userRepo->checkCv($this->userId());
        if($checkCv){
            $cv = $this->userRepo->getUserCV($this->userId());
            return view('user.editUserCv')->with('cv', $cv->userCv);
        }
        return redirect()->back();
                
    }
    public function editCv(Request $request){
        $count = (count($request->all()) - 1 )/2;
        $deletedItems = $this->userCvRepo->editCvAndReturnDeletedItemsCount($this->userId(), $request, $count);
        if($deletedItems == $count){
            $this->userRepo->changeUserCvColumn($this->userId(), 0);
            return redirect()->route('home');
        }
        return redirect()->route('user.userCV')->with('message','Successfull update!');
    }

    public function exportPdf(){
        $user = $this->userRepo->getById($this->userId());
        $cv = $this->userRepo->getUserCV($this->userId());
        $pdf = PDF::loadView('export.userCv', ['cv' => $cv->userCv, 'user' => $user]);
        return $pdf->stream($user->name.'CV.pdf');
    }

}
