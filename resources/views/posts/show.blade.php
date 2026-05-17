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

    .back-link:hover {
        color: var(--text);
    }

    .back-link::before {
        content: '←';
    }

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

    .post-actions .spacer {
        flex: 1;
    }

    /* COMMENTS */
    .comments-section {
        margin-top: 70px;
        padding-top: 40px;
        border-top: 0.5px solid var(--border);
    }

    .comment-card {
        padding: 20px 0;
        border-bottom: 0.5px solid var(--border);
    }

    .comment-head {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .comment-user {
        font-size: 14px;
        font-weight: 600;
        color: var(--text);
    }

    .comment-date {
        font-size: 12px;
        color: var(--text-muted);
    }

    .comment-body {
        font-size: 15px;
        line-height: 1.8;
        color: var(--text);
        white-space: pre-line;
        padding-left: 50px;
    }

    .custom-input {
        border-radius: 14px;
        border: 1px solid var(--border);
        padding: 14px;
        font-size: 14px;
        box-shadow: none !important;
    }

    .empty-comments {
        text-align: center;
        color: var(--text-muted);
        padding: 20px 0;
    }

    @media (max-width: 520px) {
        .post-show-title {
            font-size: 30px;
        }

        .post-show-wrap {
            padding: 32px 20px 52px;
        }
    }
</style>

<div class="post-show-wrap">

    <!-- BACK -->
    <a href="{{ redirect()->back()->getTargetUrl() }}" class="back-link">
        Back
    </a>

    <!-- AUTHOR -->
    <a href="{{ route('profile.target', $post->user) }}" class="text-decoration-none"
        onclick="event.stopPropagation();">

        <div class="post-meta">

            <div class="user-avatar user-avatar-lg">
                {{ strtoupper(substr($post->user->name, 0, 1)) }}
            </div>

            <div class="post-meta-info">

                <div class="post-meta-name">
                    {{ $post->user->name }}
                </div>

                <div class="post-meta-date">
                    {{ $post->created_at->diffForHumans() }}
                </div>

            </div>

        </div>

    </a>

    <!-- TITLE -->
    <h1 class="post-show-title">
        {{ $post->title }}
    </h1>

    <hr class="post-divider">

    <!-- CONTENT -->
    <div class="post-show-body">
        {{ $post->content }}
    </div>

    <!-- ACTIONS -->
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

    <!-- COMMENTS -->
    <div class="comments-section">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 fw-semibold">
                Comments
            </h4>
        </div>

        @auth

        <form id="commentForm" class="mb-4">

            @csrf

            <div class="mb-3">
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <textarea name="content" id="commentInput" class="form-control custom-input" rows="3"
                    placeholder="Write a comment..." required></textarea>

            </div>

            <button type="submit" class="btn-primary-custom">
                Post Comment
            </button>

        </form>

        @endauth

        <!-- COMMENTS CONTAINER -->
        <div id="commentsContainer"></div>

        <!-- LOAD MORE -->
        <div class="text-center mt-4">

            <button id="loadMoreBtn" class="btn-ghost-custom d-none">

                Load More

            </button>

        </div>

    </div>

</div>

<script>
    let currentPage = 1;
    let lastPage = 1;

    const postId = @json($post->id);

    const commentsContainer =
        document.getElementById('commentsContainer');

    const loadMoreBtn =
        document.getElementById('loadMoreBtn');

    // FETCH COMMENTS
    async function fetchComments(page = 1) {

        try {

            const response = await fetch(
                `/posts/${postId}/comments?page=${page}`
            );

            const result = await response.json();

            const comments = result.data.data;

            lastPage = result.data.last_page;
            currentPage = result.data.current_page;

            if (comments.length === 0 && page === 1) {

                commentsContainer.innerHTML = `
                    <div class="empty-comments">
                        No comments yet.
                    </div>
                `;

                return;
            }

            comments.forEach(comment => {

                const commentHtml = `
        <div class="comment-card" id="comment-${comment.id}">

        <div class="d-flex justify-content-between align-items-start">

            <div class="comment-head">

                <div class="user-avatar">
                    ${comment.user.name.charAt(0).toUpperCase()}
                </div>

                <div>

                    <div class="comment-user">
                        ${comment.user.name}
                    </div>

                    <div class="comment-date">
                        ${comment.created_at_diff}
                    </div>

                </div>

            </div>

            ${
                comment.can_delete
                ?
                `
                    <button
                        class="btn btn-sm btn-link text-danger text-decoration-none p-0"
                        onclick="deleteComment(${comment.id})"
                    >
                        Delete
                    </button>
                `
                :
                ''
            }

        </div>

        <div class="comment-body">
            ${comment.content}
        </div>

        </div>

                `;

                commentsContainer.insertAdjacentHTML(
                    'beforeend',
                    commentHtml
                );

            });

            if (currentPage < lastPage) {

                loadMoreBtn.classList.remove('d-none');

            } else {

                loadMoreBtn.classList.add('d-none');

            }

        } catch (error) {

            console.error(error);

        }

    }
    async function deleteComment(commentId) {

    const confirmDelete = confirm(
        'Delete this comment?'
    );

    if (!confirmDelete) return;

    try {

        const response = await fetch(
            `/comments/${commentId}`,
            {
                method: 'DELETE',

                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }
        );

        const result = await response.json();

        if (result.status === 'success') {

            document
                .getElementById(`comment-${commentId}`)
                .remove();

        }

    } catch (error) {

        console.error(error);

    }

}
    // LOAD MORE
    loadMoreBtn.addEventListener('click', () => {

        fetchComments(currentPage + 1);

    });

    // INITIAL FETCH
    fetchComments();

    // CREATE COMMENT
    const commentForm =
        document.getElementById('commentForm');

    if (commentForm) {

        commentForm.addEventListener('submit', async function (e) {

    e.preventDefault();

    const formData = new FormData(this);

    try {

        const response = await fetch(
            `/comments`,
            {
                method: 'POST',

                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },

                body: formData
            }
        );

        const result = await response.json();

        console.log(result);

        if (!response.ok) {
            alert(result.message || 'Something went wrong');
            return;
        }

        if (result.status === 'success') {

            this.reset();

            commentsContainer.innerHTML = '';

            currentPage = 1;

            fetchComments();

        }

    } catch (error) {

        console.error(error);

    }

});

    }

</script>

@endsection