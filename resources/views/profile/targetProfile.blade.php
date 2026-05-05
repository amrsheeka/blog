@extends('layout.main')

@section('content')

<div class="container my-5">

    <!-- PROFILE HEADER -->
    <div class="card border-0 shadow rounded-4 p-4 mb-4">

        <div class="d-flex align-items-center justify-content-between flex-wrap">

            <!-- LEFT INFO -->
            <div class="d-flex align-items-center">

                <div class="avatar-xl me-3">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div>
                    <h3 class="fw-bold mb-0">{{ $user->name }}</h3>
                    <small class="text-muted">{{ $user->email }}</small>
                </div>

            </div>

            <!-- FOLLOW BUTTON (optional future feature) -->
            <div class="mt-3 mt-md-0">
                <button class="btn-ghost-custom">
                    Follow
                </button>
            </div>

        </div>

        <!-- STATS -->
        <div class="row text-center mt-4">

            <div class="col">
                <h5 class="fw-bold">{{ $posts->count() }}</h5>
                <small class="text-muted">Posts</small>
            </div>

            <div class="col">
                <h5 class="fw-bold">0</h5>
                <small class="text-muted">Followers</small>
            </div>

            <div class="col">
                <h5 class="fw-bold">0</h5>
                <small class="text-muted">Following</small>
            </div>

        </div>

    </div>

    <!-- SECTION TITLE -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Posts by {{ $user->name }}</h4>
    </div>

    <!-- POSTS -->
    <div class="row g-4">

        @forelse ($posts as $post)
            <div class="col-md-6 col-lg-4">

                <div class="card border-0 shadow-sm rounded-4 h-100 post-card">

                    <div class="card-body d-flex flex-column">

                        <h5 class="fw-bold">{{ $post->title }}</h5>

                        <p class="text-muted flex-grow-1">
                            {{ \Illuminate\Support\Str::limit($post->content, 120) }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center mt-3">

                            <small class="text-muted">
                                {{ $post->created_at->diffForHumans() }}
                            </small>

                            <a href="{{ route('posts.show', $post) }}"
                               class="btn-ghost-custom">
                                Read →
                            </a>

                        </div>

                    </div>

                </div>

            </div>
        @empty

            <div class="text-center text-muted mt-5">
                This user hasn't posted anything yet 😢
            </div>

        @endforelse

    </div>

</div>

<style>
.avatar-xl {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #4e73df, #1cc88a);
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    font-weight: bold;
}

.post-card {
    transition: 0.2s;
}

.post-card:hover {
    transform: translateY(-4px);
}
</style>

@endsection