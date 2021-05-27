<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Profile;
use Auth;

class ProfileController extends Controller
{

    /**
     * Shows authenticated user information including their profile
     *
     * @authenticated
     *
     */
    public function user() {
        $user = User::find(Auth::id());
        $user['profile'] = $user->profile;
        return $user;
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
        if ($id != Auth::id()) {
            return;
        }

        // Validate posted form data
        $validated = $request->validate([
            'image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone'     => 'required|string',
            'mobile'    => 'required|string',
            'address'   => 'required|string',
            'city'      => 'required|string',
            'state'     => 'required|string',
            'zip'       => 'required|string',
        ]);
                
        if ($request->filled('image')) {
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName);
            $validated['image'] = $imageName;
        }    
        
        $validated['user_id'] = Auth::id();
        $profile = Profile::updateOrCreate(
            ['user_id' => $id],
            $validated
        );
        
        return response()->json([
            'message'  => 'Success'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        if ($id != Auth::id()) {
            return;
        }

        // Validate posted form data
        $validated = $request->validate([
            'name'  => 'required|string'
        ]);

        $user = User::where('id', $id)->update($validated);
        
        return response()->json([
            'message'  => 'Success'
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
        $user = User::find($id);
        $user['profile'] = $user->profile;
        return $user;
    }
}
