@extends('layout.main')

@section('content')

<div class="container py-5" style="max-width: 860px;">

    <!-- HEADER -->
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <h1 class="mb-0 fw-semibold" style="font-size: 26px;">Latest Posts</h1>
        @auth
            <a href="{{ route('posts.create') }}" class="btn btn-sm rounded-pill px-4"
               style="background:#c2410c; color:#fff; font-size:13px; font-weight:500;">
                + New Post
            </a>
        @endauth
    </div>

    <!-- GRID -->
    <div class="row g-3">
        @forelse ($posts as $post)
            <div class="col-md-6 col-lg-4">
                <div class="card border rounded-3 h-100 shadow-sm post-card"
                     style="cursor:pointer;"
                     onclick="window.location='{{ route('posts.show', $post) }}'">

                    <div class="card-body d-flex flex-column p-4">

                        <!-- Author -->
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <a href="{{ route('profile.target', $post->user) }}"
                               onclick="event.stopPropagation();"
                               class="d-flex align-items-center gap-2 text-decoration-none">
                                <div class="post-avatar">
                                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                </div>
                                <span style="font-size:12px; color:#6b6b68;">{{ $post->user->name }}</span>
                            </a>
                        </div>

                        <!-- Title -->
                        <h6 class="fw-semibold mb-2" style="font-size:14px; line-height:1.45;">
                            {{ $post->title }}
                        </h6>

                        <!-- Excerpt -->
                        <p class="text-muted flex-grow-1 mb-3" style="font-size:12px; line-height:1.6;">
                            {{ Str::limit($post->content, 100, '...') }}
                        </p>

                        <!-- Footer -->
                        <div class="d-flex align-items-center justify-content-between mt-auto">
                            <small style="font-size:11px; color:#9c9c99;">
                                {{ $post->created_at->diffForHumans() }}
                            </small>

                            <div class="d-flex align-items-center gap-3">
                                @auth
                                    <button class="like-btn d-flex align-items-center gap-1 border-0 bg-transparent p-0"
                                            data-id="{{ $post->id }}"
                                            onclick="event.stopPropagation();"
                                            style="cursor:pointer;">
                                        <i class="bi bi-heart-fill {{ $post->is_liked_by_current_user ? 'liked' : 'unliked' }}"
                                           style="font-size:13px;"></i>
                                        <span class="like-count" style="font-size:12px; color:#6b6b68;">
                                            {{ $post->likes_count }}
                                        </span>
                                    </button>
                                @endauth

                                <span style="font-size:12px; font-weight:500; color:#c2410c;">Read →</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">
                <div style="font-size:32px; margin-bottom:12px;">✍️</div>
                <p class="fw-semibold mb-1" style="font-size:16px; color:#6b6b68;">No posts yet</p>
                <p class="mb-3" style="font-size:13px;">Be the first to share something worth reading.</p>
                @auth
                    <a href="{{ route('posts.create') }}" class="btn btn-dark rounded-pill px-4" style="font-size:13px;">
                        Create the first post
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-dark rounded-pill px-4" style="font-size:13px;">
                        Join and start writing
                    </a>
                @endauth
            </div>
        @endforelse
    </div>

</div>

<style>
    .post-avatar {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: #fde8dc;
        color: #c2410c;
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 500;
        flex-shrink: 0;
    }

    .post-card {
        transition: transform 0.15s, border-color 0.15s;
    }
    .post-card:hover {
        transform: translateY(-2px);
        border-color: rgba(0,0,0,0.18) !important;
    }

    .liked  { color: #e11d48; }
    .unliked { color: #9c9c99; }
</style>

<script>
    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', function () {
            const postId    = this.dataset.id;
            const countSpan = this.querySelector('.like-count');
            const icon      = this.querySelector('i');

            fetch(`/posts/${postId}/like`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                countSpan.innerText = data.liked
                    ? parseInt(countSpan.innerText) + 1
                    : parseInt(countSpan.innerText) - 1;

                icon.classList.toggle('liked',   data.liked);
                icon.classList.toggle('unliked', !data.liked);
            });
        });
    });
</script>

@endsection