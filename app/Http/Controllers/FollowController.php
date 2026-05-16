<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, String $id)
    {
        if ($id != Auth::id()) {
            $following = Auth::user()
                ->following()
                ->where('following_id', $id)
                ->exists();
            if ($following) {
                Auth::user()->following()->detach($id);
                return response()->json([
                    'status' => 'success',
                    'message' => 'The user unfollowed successfully!',
                    'followed' => false
                ]);
            } else {
                Auth::user()->following()->attach($id);
                return response()->json([
                    'status' => 'success',
                    'message' => 'The user followed successfully!',
                    'followed' => true
                ]);
            }
        }
        return response()->json([
            'status' => 'fail',
            'message' => 'You can\'t follow yourself'
        ], 403);
    }

    /**
     * Display the specified resource.
     */
    public function showFollowers(User $user)
    {
        $followers = $user->followers;
        $followersCount = $followers->count();
        $currentUserFollowings = Auth::user()->following;
        foreach ($followers as $follower) {
            $follower['is_Followed_current_user'] = $currentUserFollowings->contains($follower);
        }

        return view('profile.followers', compact(['followers', 'followersCount', 'user']));
    }
    public function showFollowing(User $user)
    {
        $followings = $user->following;
        $followingsCount = $followings->count();
        $currentUserFollowings = Auth::user()->following;
        foreach ($followings as $follower) {
            $follower['is_Followed_current_user'] = $currentUserFollowings->contains($follower);
        }
        return view('profile.followings', compact(['followings', 'followingsCount', 'user']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Follow $follow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Follow $follow)
    {
        //
    }
}
