@extends('layout.main')
@section('content')
<!-- EDIT -->
<form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
    @method('PUT')
    
    <div id="editView" class="container my-4 hidden">
        <div class="card shadow-sm p-4 rounded-4">
            <h3 class="mb-3">Edit Post</h3>
            <input name="title" id="editTitle" class="form-control form-control-lg mb-3" value="{{$post->title}}"/>
            <textarea name="content" id="editContent" class="form-control mb-3" rows="6">{{$post->content}}</textarea>
            <button type="submit" class="btn btn-warning btn-rounded w-100" ">Save Changes</button>
        </div>
        <a class="btn btn-secondary" href="{{ route('posts.show', $post->id) }}">Cancel</a>
    </div>
</form>
@endsection