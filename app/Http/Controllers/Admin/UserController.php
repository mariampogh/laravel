<?php

namespace Laravel\Http\Controllers\Admin;

use PDF; 
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
        $this->middleware('admin');
        $this->userRepo = $userRepo;
        $this->userCvRepo = $userCvRepo;
        $this->professionRepo = $professionRepo;
       
    }

    public function index()
    {
        $users = $this->userRepo->getAll();
        $countUsers = $users->count();
        return view('admin.users')->with(['users' => $users, 'countUsers' => $countUsers]); 
    }
    
    public function create()
    {
        return view('admin.addUser');
    }

    public function store(Request $request)
    {
        $validator = $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = $this->userRepo->create($request);
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $checkCv = $this->userRepo->checkCv($id);
        if($checkCv){
            $cv = $this->userRepo->getUserCV($id);
            $user =  $this->userRepo->getById($id);
            return view('admin.userCv')->with(['user' => $user, 'cv' => $cv->userCv]);
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $user = $this->userRepo->getById($id);
        return view('admin.editUserInfo')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validate($request,[
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'address' => 'required|string|max:255',
            'phone' => 'required|numeric',
        ]);
        $user = $this->userRepo->editInfo($id, $request);
        return redirect()->route('users.index');
    }
    public function destroy($id)
    {
        $this->userRepo->delete($id);
        return redirect()->route('users.index');
    }

    public function changePwdAction($id){
        return view('admin.changePwd')
            ->with('id', $id);
    }

    public function changePwd(Request $request){
        $validator = $this->validate($request,[  
            'password' => 'required|string|min:6|confirmed'
        ]);
        $user = $this->userRepo->changePwd($request->id,$request->password);
        return redirect()->route('users.index')->with('message','Successfull update!');
    }

    public function editCv(Request $request){
        
        $count = (count($request->all()) - 2 )/2;
        $user_id = $request->id;
        $deletedItems = $this->userCvRepo->editCvAndReturnDeletedItemsCount($user_id, $request, $count);
        if($deletedItems == $count){
            $this->userRepo->changeUserCvColumn($user_id, 0);
            return redirect()->route('users.index');
        }
        return redirect()->back()->with('message','The CV successfully updated!');
    
    }

    public function exportPdf($id){


        $user = $this->userRepo->getById($id);
        $cv = $this->userRepo->getUserCV($id);
        $pdf = PDF::loadView('export.userCv', ['cv' => $cv->userCv, 'user' => $user]);
        return $pdf->stream($user->name.'CV.pdf');
    }
}
