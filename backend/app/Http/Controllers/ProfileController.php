<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Profile;

class ProfileController extends Controller
{
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
            'name'      => 'required|string',
            'phone'     => 'required|string',
            'mobile'    => 'required|string',
            'address'   => 'required|string',
            'city'      => 'required|string',
            'state'     => 'required|string',
            'zip'       => 'required|string',
        ]);
        $validated['user_id'] = Auth::id();

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        $validated['image'] = $imageName;
        request()->image->move(public_path('images'), $imageName);

        $user = User::where('id', $id)->update($validated);
        
        if ($user) {
            $profile = Profile::updateOrCreate(
                ['user_id' => $id],
                $validated
            );
        }
        
        return response()->json([
            'message'  => 'Success',
            'comment'  => $comment
        ]);
    }
}
