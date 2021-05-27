<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('comments')->orderBy('created_at', 'desc')->get();
        foreach ($posts as $post) {
            $post['user_post'] = $post->user_id == Auth::user()->id;
        }
        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        // Validate posted form data
        $validated = $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();

        $post = Post::create($validated);

        return response()->json([
            'message'  => 'Success',
            'post'     => $post
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('comments')->where('id', $id)->first();
        $post['user_post'] = $post->user_id == Auth::user()->id;
        foreach ($post['comments'] as $comment) {
            $comment['user_comment'] = $comment->user_id == Auth::user()->id;
        }
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // Validate posted form data
        $validated = $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $post = Post::where('id', $id)->update($validated);

        return response()->json([
            'message'  => 'Success',
            'post'     => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();

        return response()->json([
            'message'  => 'Success'
        ]);
    }
}
