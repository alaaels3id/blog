<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:create-post')->only('create');
        $this->middleware('can:update-post')->only('edit');
        $this->middleware('can:delete-post')->only('destroy');
    }

    public function index()
    {
        $posts = Post::all();
        return $posts != null ? view('site.posts.index', compact('posts')) : 'null';
    }

    public function create()
    {
        return view('site.posts.add');
    }

    public function store(Request $request)
    {
        $post = new Post;
        
        foreach (GetLangs() as $locale):
            $post->translateOrNew($locale)->title = $request->title[$locale];
            $post->translateOrNew($locale)->body = $request->body[$locale];
        endforeach;
        
        $post->user_id = auth()->user()->id;
        $post->save();
        
        return back()->with('success', 'Post added successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $post = POst::find(intval($id));
        return view('site.posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::find(intval($id));
        
        foreach (GetLangs() as $locale):
            $post->translateOrNew($locale)->title = $request->title[$locale];
            $post->translateOrNew($locale)->body = $request->body[$locale];
        endforeach;
        
        $post->save();
        return back()->with('success', 'Post updated successfully');
    }

    public function destroy($id)
    {
        Post::destroy(intval($id));
        DB::table('post_translations')->where('post_id', intval($id))->delete();
        return back()->with('success', 'Post deleted successfully');
    }
}
