@extends('layout.main')
@section('content')
<!-- READ -->
<div id="readView" class="container my-4 hidden">
    <div class="card shadow-sm p-4 rounded-4">
        <h2 id="readTitle" class="fw-bold">{{ $post->title }}</h2>
        <hr />
        <p id="readContent" style="white-space: pre-line;">{{ $post->content }}</p>
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary btn-rounded mt-3">Edit Post</a>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-rounded mt-3">← Back</a>
    </div>              
</div>
@endsection