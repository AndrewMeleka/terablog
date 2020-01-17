<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index(Request $request) 
    {
        // Search Proccess
        $searchTxt = request('search');
        if($searchTxt) {
            $fetchPosts = Post::where('title','LIKE','%'.$searchTxt.'%')->simplePaginate(6);
        } else {
            $fetchPosts = Post::simplePaginate(6);
        }
        // View By Category Proccess
        $byCate = request('cate');
        if($byCate) {
            $fetchPosts = Post::with('category')
            ->has('category')
            ->where('category_id', $byCate)
            ->where('title','LIKE','%'.$searchTxt.'%')
            ->simplePaginate(6);
        }
        $fetchCategories = Category::all();
        return view('welcome')->with('PostsData', $fetchPosts)->with('Categories',$fetchCategories)->with('Request',$request);
    } 
    public function viewPost(Post $id)
    {
        return view('postview')->with('PostData', $id);
    }
}
