<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Middleware\VerifyCategoriesCount;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\posts\UpdatePostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount',['create','store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts' , Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $image=$request->image->store('posts');

        Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'image'=>$image,
            'category_id'=>$request->category,
            'publish_at'=>$request->publish_at
        ]);
        session()->flash('success', 'Post added successfully.');
        return redirect(route('posts.index'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('categories',Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,Post $post)
    {
        $data=$request->all();
        //check if new image
        if($request->hasFile('image')){
        //upload it
        $image=$request->image->store('posts');
        //delete old image
        
        Storage::delete($post->image);

        $data['image']=$image;
        
        }
        //update attributes
        $post->update($data);
        //flash message
        session()->flash('success', 'Post updated successfully.');
        //redirect user
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->forceDelete();
        //delete image form storage
        Storage::delete($post->image);
        
        session()->flash('success', 'Post deleted successfully.');
        return redirect(route('posts.index'));
    }
}
