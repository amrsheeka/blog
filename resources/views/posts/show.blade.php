@extends('layout.main')

@section('content')

<style>
    .post-show-wrap {
        max-width: 660px;
        margin: 0 auto;
        padding: 52px 32px 72px;
    }

    /* Back link */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: var(--text-muted);
        text-decoration: none;
        margin-bottom: 36px;
        transition: color 0.15s;
    }
    .back-link:hover { color: var(--text); }
    .back-link::before { content: '←'; }

    /* Author meta */
    .post-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 28px;
    }
    .post-meta-info {
        display: flex;
        flex-direction: column;
    }
    .post-meta-name {
        font-size: 14px;
        font-weight: 500;
        color: var(--text);
    }
    .post-meta-date {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 1px;
    }

    /* Title */
    .post-show-title {
        font-family: 'Instrument Serif', serif;
        font-size: 42px;
        font-weight: 400;
        line-height: 1.12;
        color: var(--text);
        margin-bottom: 28px;
    }

    /* Divider */
    .post-divider {
        border: none;
        border-top: 0.5px solid var(--border);
        margin-bottom: 28px;
    }

    /* Body */
    .post-show-body {
        font-size: 16px;
        line-height: 1.85;
        color: var(--text);
        white-space: pre-line;
    }

    /* Actions */
    .post-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 48px;
        padding-top: 28px;
        border-top: 0.5px solid var(--border);
        flex-wrap: wrap;
    }
    .post-actions .spacer { flex: 1; }

    @media (max-width: 520px) {
        .post-show-title { font-size: 30px; }
        .post-show-wrap { padding: 32px 20px 52px; }
    }
</style>

<div class="post-show-wrap">

    <a href="{{ route('posts.index') }}" class="back-link">Back to posts</a>

    <!-- Author Meta -->
    <div class="post-meta">
        <div class="user-avatar user-avatar-lg">
            {{ strtoupper(substr($post->user->name, 0, 1)) }}
        </div>
        <div class="post-meta-info">
            <div class="post-meta-name">{{ $post->user->name }}</div>
            <div class="post-meta-date">{{ $post->created_at->diffForHumans() }}</div>
        </div>
    </div>

    <!-- Title -->
    <h1 class="post-show-title">{{ $post->title }}</h1>

    <hr class="post-divider">

    <!-- Content -->
    <div class="post-show-body">{{ $post->content }}</div>

    <!-- Actions -->
    @auth
        @if (auth()->id() === $post->user_id)
            <div class="post-actions">
                <a href="{{ route('posts.edit', $post) }}" class="btn-ghost-custom">
                    ✏️ Edit
                </a>

                <form action="{{ route('posts.delete', $post) }}" method="POST" style="margin:0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger-custom"
                        onclick="return confirm('Delete this post? This cannot be undone.')">
                        🗑 Delete
                    </button>
                </form>
            </div>
        @endif
    @endauth

</div>

@endsection