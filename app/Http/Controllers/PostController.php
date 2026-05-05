<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            $post['is_liked_by_current_user'] = $this->isLikedByCurrentUser($post);
        }
        $posts->load('user');
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdatePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        Post::create($data);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (!$post) {
            abort(404);
        }
        $post->load('user');
        $post->is_liked_by_current_user = $this->isLikedByCurrentUser($post);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (!$post) {
            abort(404);
        }
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to edit this post.');
        }
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $post->update($data);
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to update this post.');
        }
        return redirect()->route('posts.show', ['post' => $post->id])->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to delete this post.');
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
    public function like(Post $post)
    {
        
        if( !Like::where('user_id', Auth::id())->where('post_id', $post->id)->exists()) {
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id,
            ]);
            $post->increment('Likes_count');
        }else {
            return $this->unlike($post);
        }
        return response()->json([
            'status' => 'success',
            'liked'=>true,
            'message' => 'Post liked successfully!',
            'data' => [
                'post_id' => $post->id,
                'likes_count' => $post->Likes_count,
            ],
        ]);
    }
    public function unlike(Post $post)
    {
        Like::where('user_id', Auth::id())->where('post_id', $post->id)->delete();
        $post->decrement('Likes_count');
        return response()->json([
            'status' => 'success',
            'liked' => false,
            'message' => 'Post unliked successfully!',
            'data' => [
                'post_id' => $post->id,
                'likes_count' => $post->Likes_count,
            ],
        ]);
    }
    public function isLikedByCurrentUser(Post $post)
    {
        return Like::where('user_id', Auth::id())->where('post_id', $post->id)->exists();
    }
}
