<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'comment' => 'required|string',
            'post_id' => 'required'
        ]);

        $validated['user_id'] = Auth::id();

        $comment = Comment::create($validated);

        return response()->json([
            'message'  => 'Success',
            'comment'  => $comment
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
        $comment = Comment::find($id);
        $comment['user_comment'] = $comment->user_id == Auth::user()->id;
        return $comment;
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
            'comment' => 'required|string'
        ]);

        $comment = Comment::where('id', $id)->update($validated);

        return response()->json([
            'message'  => 'Success',
            'comment'  => $comment
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
        Comment::where('id', $id)->delete();

        return response()->json([
            'message'  => 'Success'
        ]);
    }
}
