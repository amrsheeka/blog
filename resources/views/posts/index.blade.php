@extends('layout.main')

@section('content')
<style>
    .index-wrap {
        max-width: 860px;
        margin: 0 auto;
        padding: 44px 32px;
    }

    .index-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
    }

    .index-title {
        font-family: 'Instrument Serif', serif;
        font-size: 30px;
        font-weight: 400;
    }

    .posts-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }

    @media (max-width: 768px) {
        .posts-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 520px) {
        .posts-grid {
            grid-template-columns: 1fr;
        }

        .index-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 72px 0;
        color: var(--text-faint);
    }

    .empty-state-icon {
        font-size: 36px;
        margin-bottom: 16px;
    }

    .empty-state-text {
        font-family: 'Instrument Serif', serif;
        font-size: 20px;
        color: var(--text-muted);
        margin-bottom: 8px;
    }

    .empty-state-sub {
        font-size: 13px;
        color: var(--text-faint);
        margin-bottom: 24px;
    }

    .like-btn {
        background: none;
        border: none;
        cursor: pointer;
    }
    .likecount {
        font-size: 14px;
        margin-left: 4px;
    }
    .liked {
        color: red;
    }
    .unliked {
        color: gray;
    }
</style>
<div class="index-wrap">

    <div class="index-header">
        <h1 class="index-title">Latest posts</h1>
        @auth
        <a href="{{ route('posts.create') }}" class="btn-accent-custom">
            + New post
        </a>
        @endauth
    </div>

    <div class="posts-grid">
        @forelse ($posts as $post)
        <a href="{{ route('posts.show', $post) }}" class="post-card">
            <div class="post-card-author">
                <div class="user-avatar">
                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                </div>
                <span class="post-card-author-name">{{ $post->user->name }}</span>
            </div>

            <div class="post-card-title">{{ $post->title }}</div>
            <div class="post-card-excerpt">{{ Str::limit($post->content, 100, '...') }}</div>

            <div class="post-card-footer d-flex justify-content-between align-items-center">
                <span class="post-card-date">{{ $post->created_at->diffForHumans() }}</span>
                
               @auth
                    <button class="like-btn" data-id="{{ $post->id }}" onclick="event.preventDefault(); event.stopPropagation();">
                    <i class="bi bi-heart-fill {{ $post->is_liked_by_current_user ? 'liked' : 'unliked' }}"></i>
                    <span class="like-count">{{ $post->likes_count }}</span>
                </button>
               @endauth

                <span class="post-card-read">Read →</span>
            </div>
        </a>
        @empty
        <div class="empty-state">
            <div class="empty-state-icon">✍️</div>
            <div class="empty-state-text">No posts yet</div>
            <div class="empty-state-sub">Be the first to share something worth reading.</div>
            @auth
            <a href="{{ route('posts.create') }}" class="btn-primary-custom">
                Create the first post
            </a>
            @else
            <a href="{{ route('register') }}" class="btn-primary-custom">
                Join and start writing
            </a>
            @endauth
        </div>
        @endforelse
    </div>

</div>
<script>
document.querySelectorAll('.like-btn').forEach(button => {
    button.addEventListener('click', function () {
        let postId = this.dataset.id;
        let countSpan = this.querySelector('.like-count');
        let icon = this.querySelector('i');

        fetch(`http://127.0.0.1:8000/posts/${postId}/like`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            let count = parseInt(countSpan.innerText);

            if (data.liked) {
                countSpan.innerText = count + 1;
                icon.classList.remove('unliked');
                icon.classList.add('liked');
            } else {
                countSpan.innerText = count - 1;
                icon.classList.remove('liked');
                icon.classList.add('unliked');
            }
        });
    });
});
</script>
@endsection