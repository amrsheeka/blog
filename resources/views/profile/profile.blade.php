@extends('layout.main')

@section('content')
<div class="container my-5">

    <!-- PROFILE HEADER -->
    <div class="card border-0 shadow rounded-4 p-4 mb-4">

        <div class="d-flex align-items-center">
            <div class="avatar-lg me-3">
                {{ strtoupper(substr($profile->name, 0, 1)) }}
            </div>

            <div>
                <h4 class="fw-bold mb-0">{{ $profile->name }}</h4>
                <small class="text-muted">{{ $profile->email }}</small>
            </div>
        </div>

        <!-- Stats -->
        <div class="row text-center mt-4">
            <div class="col">
                <h5 class="fw-bold">{{ $posts->count() }}</h5>
                <small class="text-muted">Posts</small>
            </div>
            <div class="col">
                <h5 class="fw-bold">—</h5>
                <small class="text-muted">Followers</small>
            </div>
            <div class="col">
                <h5 class="fw-bold">—</h5>
                <small class="text-muted">Following</small>
            </div>
        </div>

    </div>

    <!-- POSTS -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">My Posts</h4>

        <a href="{{ route('posts.create') }}" class="btn btn-primary rounded-pill px-3">
            + New Post
        </a>
    </div>

    <div class="row g-4">
        @forelse ($posts as $post)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body d-flex flex-column">

                        <h5 class="fw-bold">{{ $post->title }}</h5>

                        <p class="text-muted flex-grow-1">
                            {{ Str::limit($post->content, 100) }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">
                                {{ $post->created_at->diffForHumans() }}
                            </small>

                            <div class="d-flex gap-1">
                                <a href="{{ route('posts.show', $post) }}"
                                   class="btn btn-sm btn-outline-primary rounded-pill">
                                    View
                                </a>

                                <a href="{{ route('posts.edit', $post) }}"
                                   class="btn btn-sm btn-outline-warning rounded-pill">
                                    Edit
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        @empty
            <div class="text-center text-muted mt-4">
                You haven't created any posts yet 😢
            </div>
        @endforelse
    </div>

</div>

<style>
.avatar-lg {
    width: 60px;
    height: 60px;
    background: #4e73df;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    font-weight: bold;
}
</style>
@endsection