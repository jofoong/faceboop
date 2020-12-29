<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Image;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return view("profiles.show", ["profile"=>$profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        return view("profiles.edit", ["profile"=>$profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|',
            'bio' => 'max:500',
            'location' => 'max:200'
        ]);

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'image|mimes:jpeg,png,jpg,gif,svg|']);
            $imageName = $request->file('image')->getClientOriginalName();
            $image = new Image;
            $image->image = $imageName;
            $image->imageable_id = $profile->id;
            $image->imageable_type = 'App\Models\Profile';
            $image->save();

            $request->image->move(public_path('images'), $imageName);
        }
        $profile->bio = $validated['bio'];
        $profile->location = $validated['location'];
        $profile->save();

        session()->flash('message', 'Profile edited!');
        return view('profiles.show', ["profile"=>$profile]);
    }
}
