<?php

namespace Laravel\Http\Controllers;
//     <!--            @if ( count( $errors ) > 0 )
//                 @if($errors->has())
//    @foreach ($errors->all() as $error)
//       <div>{{ $error }}</div>
//   @endforeach
// @endif
// @endif -->
use Laravel\Post;
use Laravel\User;
use Illuminate\Http\Request;
use Notification;
use Laravel\Notifications\NewBlog; 

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => ['index','store', 'update', 'destroy']]);
    }
    
    public function index()
    {
        $posts = Post::all();
        return view('posts.index')
            ->with('posts', json_encode($posts));
    }

 
    public function store(Request $request)
    {
        $validator = $this->validate($request,[
            'post_name' => 'required',
            'post' => 'required'
        ]);        
        $post = new Post;
        $post->post_name = $request->post_name;
        $post->post = $request->post;
        $post->save();

        $users = User::all();
        Notification::send($users, new NewBlog($post));

        return $post;
        
    }
    public function show($id)
    {
        return $id;
    }

    
   
    public function update(Request $request)
    {
        
        $validator = $this->validate($request,[
            'post_name' => 'required',
            'post' => 'required'
        ]);

        $post = Post::find($request->post_id);
        $post->post_name = $request->post_name;
        $post->post = $request->post;
        
        return $post->save();
    
    }

   
    public function destroy($id)
    {
        return  Post::destroy($id);
    }
}
