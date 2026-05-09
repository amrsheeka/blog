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
        $following = Follow::where('follower_id', Auth::id())->where('following_id',$id)->exists();
        if ($following) {
            Follow::where('follower_id',Auth::id())->where('following_id',$id)->delete();
            return response()->json([
                'status'=>'success',
                'message'=>'The user unfollowed successfully!',
                'followed'=>false
            ]);
        } else {
            Follow::create([
                'follower_id' => Auth::id(),
                'following_id' => $id
            ]);
            return response()->json([
                'status'=>'success',
                'message'=>'The user followed successfully!',
                'followed'=>true
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Follow $follow)
    {
        //
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
