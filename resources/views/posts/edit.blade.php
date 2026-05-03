@extends('layout.main')

@section('content')

<style>
    .form-wrap {
        max-width: 680px;
        margin: 0 auto;
        padding: 52px 32px 72px;
    }
    .form-back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: var(--text-muted);
        text-decoration: none;
        margin-bottom: 36px;
        transition: color 0.15s;
    }
    .form-back-link:hover { color: var(--text); }
    .form-back-link::before { content: '←'; }

    .form-heading {
        font-family: 'Instrument Serif', serif;
        font-size: 36px;
        font-weight: 400;
        color: var(--text);
        margin-bottom: 6px;
    }
    .form-subheading {
        font-size: 14px;
        color: var(--text-muted);
        margin-bottom: 36px;
    }

    .field-group { margin-bottom: 22px; }

    .field-label {
        display: block;
        font-size: 11px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.09em;
        color: var(--text-muted);
        margin-bottom: 8px;
    }

    .field-input {
        width: 100%;
        padding: 11px 16px;
        font-size: 15px;
        font-family: 'DM Sans', sans-serif;
        background: var(--surface);
        border: 0.5px solid var(--border-strong);
        border-radius: 10px;
        color: var(--text);
        outline: none;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .field-input::placeholder { color: var(--text-faint); }
    .field-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(194, 65, 12, 0.08);
    }
    .field-input.is-invalid {
        border-color: #f87171;
        box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.1);
    }

    .field-textarea {
        resize: vertical;
        min-height: 200px;
        line-height: 1.7;
    }

    .field-error {
        font-size: 12px;
        color: #dc2626;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 32px;
        align-items: center;
    }

    /* Edit-mode indicator badge */
    .edit-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 500;
        padding: 4px 12px;
        border-radius: 999px;
        background: #fef9c3;
        color: #a16207;
        border: 0.5px solid #fde68a;
        margin-bottom: 20px;
    }

    @media (max-width: 520px) {
        .form-wrap { padding: 32px 20px 52px; }
        .form-heading { font-size: 28px; }
        .form-actions { flex-direction: column; align-items: stretch; }
        .form-actions a, .form-actions button { text-align: center; justify-content: center; }
    }
</style>

<div class="form-wrap">

    <a href="{{redirect()->back()->getTargetUrl() }}" class="form-back-link">Back to post</a>

    <div class="edit-badge">✏️ Editing post</div>

    <h1 class="form-heading">Edit post</h1>
    <p class="form-subheading">Make your changes below and save when you're ready.</p>

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="field-group">
            <label class="field-label" for="title">Title</label>
            <input
                id="title"
                name="title"
                type="text"
                class="field-input @error('title') is-invalid @enderror"
                placeholder="Give your post a compelling title..."
                value="{{ old('title', $post->title) }}"
                autofocus
            >
            @error('title')
                <div class="field-error">✕ {{ $message }}</div>
            @enderror
        </div>

        <!-- Content -->
        <div class="field-group">
            <label class="field-label" for="content">Content</label>
            <textarea
                id="content"
                name="content"
                class="field-input field-textarea @error('content') is-invalid @enderror"
                placeholder="Write your post here..."
            >{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="field-error">✕ {{ $message }}</div>
            @enderror
        </div>

        <!-- Actions -->
        <div class="form-actions">
            <button type="submit" class="btn-primary-custom">
                💾 Save changes
            </button>
            <a href="{{redirect()->back()->getTargetUrl() }}" class="btn-ghost-custom">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection