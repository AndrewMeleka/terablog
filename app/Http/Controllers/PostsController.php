<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('countCategories')->only('create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.posts.index')->with('postsData',Post::all())->with('categories',Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.posts.create')->with('categories',Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        // Upload image to storage
        $imagePath = $request['image']->store('posts','public');

        // Add New Record To Database
        $myPost = new Post(); 
        $myPost->title = $request['title'];
        $myPost->body = $request['body'];
        $myPost->content = $request['content'];
        $myPost->image = $imagePath;
        $myPost->published_at = $request['published'];
        $myPost->category_id = $request['category'];

        $myPost->save();
        
        // Flash Message
        session()->flash('success','Post Added Successfully');
        
        // Redirect
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
    public function edit($id)
    {
        $selectedPost = Post::find($id);
        return view('cms.posts.create')->with('postData',$selectedPost)->with('categories',Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        // fetch selected post
        $selectedPost = Post::find($id);

        // check if new image uploaded ?  upload new one  + delete old one : keep everything
        if(isset($request->image)){
            $newImage = $request['image']->store('posts','public');
            Storage::disk('public')->delete($selectedPost->image);
            $selectedPost->image = $newImage; // update image in database
        }

        // Update The Post
        $selectedPost->title = $request['title'];
        $selectedPost->body = $request['body'];
        $selectedPost->content = $request['content'];
        $selectedPost->published_at = $request['published'];
        $selectedPost->category_id = $request['category'];
        
        $selectedPost->save();

        // flash message
        session()->flash('success','Post Updated Successfully');

        // Redirect User
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req,$id)
    {
        // Fetch Post
        $selectedPost = Post::withTrashed()->find($id);

        // If coming from trash then delete esle forceDelete
        if(isset($req['trashonly'])){
            $selectedPost->delete();
            session()->flash('success','Post Moved To Trash');
        } else {
            $selectedPost->forceDelete();
            Storage::disk('public')->delete($selectedPost->image);
            session()->flash('success','Post Deleted Successfully');
        }



        // Redirect
        return redirect(route('posts.index'));
    }

    /**
     * Show Trash Posts 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        return view('cms.posts.trash')->with('postsData',Post::onlyTrashed()->get());
    }


    /**
     * Restore Post 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        // fetch post selected
        $selectedPost = Post::onlyTrashed()->find($id);

        // Restore Selected Post
        $selectedPost->restore();

        // Flash Message
        session()->flash('success','Post Restored Successfully');

        // redirect
        return redirect(route('trashPost'));
    }

}
