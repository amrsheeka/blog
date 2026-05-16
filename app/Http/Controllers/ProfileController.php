<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Auth::user();
        $posts = Post::where('user_id', Auth::id())->get();
        $followersCount = $profile->followers->count();
        $followingCount = $profile->following->count();
        return view('profile.profile', compact(['profile', 'posts','followersCount','followingCount']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile) {}

     public function showTarget(User $user)
    {
        $posts = Post::where('user_id', $user->id)->get();
        $user['is_Followed_current_user'] = $user->followers->contains(Auth::user());
        $followersCount = $user->followers->count();
        $followingCount = $user->following->count();
        return view('profile.targetProfile', compact(['user', 'posts','followersCount','followingCount']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProfileRequest $request)
    {
        $user = Auth::user();

        $data = $request->validated();
        unset($data['email']);
        if($request->has('password') && $request->password) {
            $data['password'] = bcrypt($request->password);

        }else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('profile')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
