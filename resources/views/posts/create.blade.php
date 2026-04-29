@extends('layout.main')
@section('content')
<!-- CREATE -->
    <div id="createView" class="container my-4 hidden">
        <div class="card shadow-sm p-4 rounded-4">
            <h3 class="mb-3">Create Post</h3>
            <input id="createTitle" class="form-control form-control-lg mb-3" placeholder="Post title" />
            <textarea id="createContent" class="form-control mb-3" rows="6"
                placeholder="Write your content..."></textarea>
            <button class="btn btn-primary btn-rounded w-100" >Publish</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-rounded mt-3">← Back</a>
        </div>
    </div>
@endsection