<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{
    //
    public function index(){
        
        // $posts = auth()->user()->posts()->paginate(5);
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('admin.posts.index', ['posts' => $posts]);
    }
    
    public function show(Post $post){
        
        return view('blog-post', ['post' => $post]);
    }
    
    public function create(){
        
        $this->authorize('create', Post::class);
        
        return view('admin.posts.create');
    }
    
    public function store(){
        
        // Auth::user();
        // auth()->user();
        // dd(request()->all());
        $this->authorize('create', Post::class);
        
        $inputs = request()->validate([
            'title'=> 'required|min:8|max:255',
            'post_image'=> 'file',
            'body'=> 'required'
        ]);
        
        if(request('post_image')){
            
            $inputs['post_image'] = request('post_image')->store('images');
        }
        
        auth()->user()->posts()->create($inputs);
        
        Session::flash('post-create-message', 'Post has been created');
        return redirect()->route('post.index');
        
    }
    
    public function edit(Post $post){
        
        $this->authorize('view', $post);
        // if(auth()->user()->can('view', $post)){   
        // }
        
        return view('admin.posts.edit', ['post' => $post]);
    }

    
    public function update(Post $post){
        
        $inputs = request()->validate([
            'title'=> 'required|min:8|max:255',
            'post_image'=> 'file',
            'body'=> 'required'
        ]);
        
        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }
        
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        
        $this->authorize('update', $post);
        
        $post->save();
        
        session()->flash('post-updated-message', 'Post updated successfully');
        
        return redirect()->route('post.index');
        
    }
    
    
    public function destroy(Post $post){
        
        $this->authorize('delete', $post);
        $post->delete();
        
        Session::flash('message', 'Post has been deleted');
        
        return back();
    }
}
