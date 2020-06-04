<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function __construct()
    {
        $this->middleware('auth', ['except'=>['index','show']]);
    }

    public function index()
    {
        // $post = Post::all(); // get all properties of POST   
        // $posts = DB::table('posts')->orderbyRaw('created_at DESC')->get();//select all from posts with sql structures
        // $posts = Post::orderBy('created_at','desc')->get(); //order filtered posts by time created
        // $posts = Post::orderBy('created_at','desc')->take(1)->get(); //choose to show only 1 item
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts',$posts );//view /posts by index.blade showing $posts
        //return $post = Post::where('title','Post One')->get(); //get posts by title = 'post one'

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' =>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);

        if ($request->hasFile('cover_image')) {
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            $fileName =pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileExt = $request->file('cover_image')->getClientOriginalExtension();

            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;

            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        } else {
            $fileNameToStore = 'no_image.jpg';
        }
        

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id =auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        return redirect('/posts')->with('success','New post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if (auth()->user()->id !== $post->user_id) {
            return redirect('posts')->with('error','Unauthorized Post');
        }
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' =>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);

        if ($request->hasFile('cover_image')) {
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            $fileName =pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileExt = $request->file('cover_image')->getClientOriginalExtension();

            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;

            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }

        $post = Post::find($id);
        if (auth()->user()->id !== $post->user_id) {
            return redirect('posts')->with('error','Unauthorized Post');
        }
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if ($request->hasFile('cover_image')) {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        return redirect('/posts')->with('success','Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (auth()->user()->id !== $post->user_id) {
            return redirect('posts')->with('error','Unauthorized Post');
        }
        if($post->cover_image != 'no_image.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success','Post Removed');
    }
}
