@extends('layout.main')

@section('content')

<style>
    /* ── HERO ── */
    .hero-section {
        max-width: 860px;
        margin: 0 auto;
        padding: 72px 32px 48px;
    }
    .hero-eyebrow {
        font-size: 11px;
        font-weight: 500;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 18px;
    }
    .hero-heading {
        font-family: 'Instrument Serif', serif;
        font-size: 56px;
        line-height: 1.08;
        font-weight: 400;
        color: var(--text);
        margin-bottom: 20px;
    }
    .hero-heading em {
        font-style: italic;
        color: var(--accent);
    }
    .hero-sub {
        font-size: 16px;
        color: var(--text-muted);
        max-width: 460px;
        line-height: 1.7;
        margin-bottom: 32px;
    }
    .hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }

    /* ── STATS BAR ── */
    .stats-bar {
        max-width: 860px;
        margin: 0 auto 52px;
        padding: 24px 32px 0;
        border-top: 0.5px solid var(--border);
        display: flex;
        gap: 0;
    }
    .stat-item {
        flex: 1;
        padding-right: 28px;
    }
    .stat-item + .stat-item {
        border-left: 0.5px solid var(--border);
        padding-left: 28px;
        padding-right: 28px;
    }
    .stat-number {
        font-family: 'Instrument Serif', serif;
        font-size: 30px;
        color: var(--text);
        line-height: 1;
        margin-bottom: 4px;
    }
    .stat-label {
        font-size: 11px;
        color: var(--text-faint);
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    /* ── FEATURES ── */
    .features-section {
        max-width: 860px;
        margin: 0 auto 52px;
        padding: 0 32px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }
    .feature-card {
        background: var(--surface);
        border: 0.5px solid var(--border);
        border-radius: 14px;
        padding: 22px;
        transition: border-color 0.15s;
    }
    .feature-card:hover { border-color: var(--border-strong); }
    .feature-icon {
        width: 34px; height: 34px;
        background: var(--accent-light);
        border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        font-size: 16px;
        margin-bottom: 14px;
    }
    .feature-title {
        font-size: 14px; font-weight: 500;
        margin-bottom: 5px;
    }
    .feature-desc {
        font-size: 13px; color: var(--text-muted);
        line-height: 1.55;
    }

    /* ── SECTION HEADER ── */
    .section-header {
        max-width: 860px;
        margin: 0 auto 18px;
        padding: 0 32px;
        display: flex; align-items: baseline; justify-content: space-between;
    }
    .section-title {
        font-family: 'Instrument Serif', serif;
        font-size: 24px; font-weight: 400;
    }

    /* ── POSTS GRID ── */
    .posts-grid {
        max-width: 860px;
        margin: 0 auto 52px;
        padding: 0 32px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }

    /* ── CTA ── */
    .cta-section {
        max-width: 860px;
        margin: 0 auto 52px;
        padding: 0 32px;
    }
    .cta-inner {
        background: var(--text);
        border-radius: 18px;
        padding: 44px 52px;
        display: flex; align-items: center; justify-content: space-between;
        gap: 32px;
    }
    .cta-heading {
        font-family: 'Instrument Serif', serif;
        font-size: 26px; font-weight: 400;
        color: #fff;
        margin-bottom: 6px;
    }
    .cta-sub {
        font-size: 13px;
        color: rgba(255,255,255,0.5);
        margin: 0;
    }
    .btn-cta {
        font-family: 'DM Sans', sans-serif;
        font-size: 13px; font-weight: 500;
        padding: 11px 28px;
        border-radius: 999px;
        background: #fff; color: var(--text);
        border: none; cursor: pointer;
        white-space: nowrap;
        text-decoration: none;
        transition: background 0.15s;
        display: inline-block;
    }
    .btn-cta:hover { background: #f0f0f0; color: var(--text); }
</style>

<!-- HERO -->
<div class="hero-section">
    <div class="hero-eyebrow">A place to write &amp; be read</div>
    <h1 class="hero-heading">
        Share your ideas<br>with the <em>world</em>
    </h1>
    <p class="hero-sub">
        Write, discover, and connect through powerful content.
        Join our community of writers sharing their best ideas.
    </p>
    <div class="hero-actions">
        @guest
            <a href="{{ route('register') }}" class="btn-primary-custom">
                Start writing
            </a>
            <a href="{{ route('login') }}" class="btn-ghost-custom">
                Login
            </a>
        @endguest
        <a href="{{ route('posts.index') }}" class="btn-ghost-custom">
            Browse posts →
        </a>
    </div>
</div>

<!-- STATS -->
<div class="stats-bar">
    <div class="stat-item">
        <div class="stat-number">{{ $posts->count() }}+</div>
        <div class="stat-label">Posts published</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">100+</div>
        <div class="stat-label">Writers</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">1K+</div>
        <div class="stat-label">Monthly readers</div>
    </div>
</div>

<!-- FEATURES -->
<div class="features-section">
    <div class="feature-card">
        <div class="feature-icon">✍️</div>
        <div class="feature-title">Write easily</div>
        <div class="feature-desc">A clean editor to express your thoughts without distraction.</div>
    </div>
    <div class="feature-card">
        <div class="feature-icon">⚡</div>
        <div class="feature-title">Fast experience</div>
        <div class="feature-desc">Smooth and responsive interface on every device.</div>
    </div>
    <div class="feature-card">
        <div class="feature-icon">🌍</div>
        <div class="feature-title">Reach people</div>
        <div class="feature-desc">Share your ideas with readers around the world.</div>
    </div>
</div>

<!-- LATEST POSTS -->
<div class="section-header">
    <div class="section-title">Latest posts</div>
    <a href="{{ route('posts.index') }}" class="btn-ghost-custom" style="font-size: 12px; padding: 6px 16px;">
        View all →
    </a>
</div>

<div class="posts-grid">
    @foreach ($posts->take(6) as $post)
        <a href="{{ route('posts.show', $post) }}" class="post-card">
            <div class="post-card-author">
                <div class="user-avatar">
                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                </div>
                <span class="post-card-author-name">{{ $post->user->name }}</span>
            </div>
            <div class="post-card-title">{{ $post->title }}</div>
            <div class="post-card-excerpt">{{ Str::limit($post->content, 100) }}</div>
            <div class="post-card-footer">
                <span class="post-card-date">{{ $post->created_at->diffForHumans() }}</span>
                <span class="post-card-read">Read →</span>
            </div>
        </a>
    @endforeach
</div>

<!-- CTA -->
<div class="cta-section">
    <div class="cta-inner">
        <div>
            <div class="cta-heading">Ready to share your story?</div>
            <p class="cta-sub">Join our growing community of writers today.</p>
        </div>
        <a href="{{ route('posts.create') }}" class="btn-cta">
            Create your first post
        </a>
    </div>
</div>

@endsection