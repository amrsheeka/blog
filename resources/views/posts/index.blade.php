@extends('layout.main')
@section('content')
<!-- HOME -->
    <div id="homeView" class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Latest Posts</h3>
            
        </div>
        @foreach ($posts as $post)
            <div class="card my-3">
                <div class="card-header">
                    {{ $post->user->name}}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ substr($post->content, 0, 100) . ' .....' }}</p>
                    <!-- {{-- <a href="{{ url('/posts/' . $post->id) }}" class="btn btn-primary">Show Full Post</a> --}} -->
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Show Full Post</a>
                </div>
            </div>
        @endforeach
        <div id="postsList" class="row g-4"></div>
    </div>
@endsection