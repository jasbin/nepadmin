<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostsRequest;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!empty($request->search)){
            $search = $request->search;
            $posts = Post::where('title','LIKE','%'.$search.'%')->orWhere('body','LIKE','%'.$search.'%')->orderBy('created_at','desc')->paginate(2);
            return view('posts.index')->with('posts',$posts);
        }
            //$posts = Post::all();
            //$posts = Post::orderBy('created_at',  'desc')->get();
            $posts = Post::orderBy('created_at',  'desc')->paginate(3);
            return view('posts.index')->with('posts', $posts);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return back();
    }

    public function getByID($id){
        $status = false;
        // Check if id is empty or not
        if(!empty($id)){
            $post = Post::select('id','title','body')->find($id);
            $status = !empty($post) ? true : false;
            return response()->json(['status' => $status, 'result' => $post]);
        }
        return response()->json(['status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $post = Post::findOrFail($request->input('post_id'));
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->update();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $post =Post::findorFail($id);
        $post->delete();
        return back();
    }
}
