@extends('layout.main')

@section('content')

<div class="container py-5" style="max-width: 860px;">

    <!-- PROFILE HEADER -->
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-4 mb-4 pb-4 border-bottom">

        <!-- Identity -->
        <div class="d-flex align-items-center gap-3">
            <div class="profile-avatar">
                {{ strtoupper(substr($profile->name, 0, 1)) }}
            </div>
            <div>
                <h4 class="mb-0 fw-semibold" style="font-size: 22px;">{{ $profile->name }}</h4>
                <small class="text-muted">{{ $profile->email }}</small>
            </div>
        </div>

        <!-- Stats -->
        <div class="d-flex border rounded-3 overflow-hidden">
            <div class="stat-cell text-center px-4 py-3">
                <div class="stat-num">{{ $posts->count() }}</div>
                <div class="stat-label">Posts</div>
            </div>
            <div class="stat-cell text-center px-4 py-3 border-start">
                <div class="stat-num">—</div>
                <div class="stat-label">Followers</div>
            </div>
            <div class="stat-cell text-center px-4 py-3 border-start">
                <div class="stat-num">—</div>
                <div class="stat-label">Following</div>
            </div>
        </div>

    </div>

    <!-- EDIT PROFILE -->
    <div class="card border rounded-3 p-4 mb-5 shadow-sm">
        <h6 class="fw-semibold mb-4" style="font-size: 14px;">Edit Profile</h6>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3 mb-3">

                <!-- Name -->
                <div class="col-md-6">
                    <label class="form-label field-label">Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control field-input"
                        value="{{ old('name', $profile->name) }}"
                    >
                </div>

                <!-- Email disabled -->
                <div class="col-md-6">
                    <label class="form-label field-label">Email</label>
                    <input
                        type="email"
                        class="form-control field-input"
                        value="{{ $profile->email }}"
                        disabled
                    >
                </div>

            </div>

            <div class="row g-3 mb-4">

                <!-- New Password -->
                <div class="col-md-6">
                    <label class="form-label field-label">New Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control field-input @error('password') is-invalid @enderror"
                        placeholder="Leave blank to keep current"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="col-md-6">
                    <label class="form-label field-label">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control field-input"
                        placeholder="Repeat new password"
                    >
                </div>

            </div>

            <button type="submit" class="btn btn-dark rounded-pill px-4" style="font-size: 13px;">
                💾 Save Changes
            </button>

        </form>
    </div>

    <!-- MY POSTS -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="mb-0 fw-semibold">My Posts</h5>
        <a href="{{ route('posts.create') }}" class="btn btn-sm rounded-pill px-3" style="background:#c2410c; color:#fff; font-size:13px;">
            + New Post
        </a>
    </div>

    <div class="row g-3">
        @forelse ($posts as $post)
            <div class="col-md-6 col-lg-4">
                <div class="card border rounded-3 h-100 shadow-sm post-card">
                    <div class="card-body d-flex flex-column p-4">

                        <h6 class="fw-semibold mb-2" style="font-size: 14px; line-height: 1.45;">
                            {{ $post->title }}
                        </h6>

                        <p class="text-muted flex-grow-1 mb-3" style="font-size: 12px; line-height: 1.6;">
                            {{ Str::limit($post->content, 100) }}
                        </p>

                        <div class="d-flex align-items-center justify-content-between mt-auto">
                            <small class="text-muted" style="font-size: 11px;">
                                {{ $post->created_at->diffForHumans() }}
                            </small>
                            <div class="d-flex gap-2">
                                <a href="{{ route('posts.show', $post) }}"
                                   class="btn btn-sm rounded-pill border px-3"
                                   style="font-size: 11px; font-weight: 500;">
                                    View
                                </a>
                                <a href="{{ route('posts.edit', $post) }}"
                                   class="btn btn-sm rounded-pill px-3"
                                   style="font-size: 11px; font-weight: 500; background: #fde8dc; color: #c2410c; border: 0.5px solid rgba(194,65,12,0.2);">
                                    Edit
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">
                <div style="font-size: 32px; margin-bottom: 12px;">✍️</div>
                <p class="mb-1 fw-semibold" style="font-size: 16px; color: #6b6b68;">No posts yet</p>
                <p class="mb-3" style="font-size: 13px;">Start sharing your ideas with the world.</p>
                <a href="{{ route('posts.create') }}" class="btn btn-dark rounded-pill px-4" style="font-size: 13px;">
                    Create your first post
                </a>
            </div>
        @endforelse
    </div>

</div>

<style>
    .profile-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #fde8dc;
        color: #c2410c;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        font-weight: 500;
        border: 2px solid rgba(194,65,12,0.15);
        flex-shrink: 0;
    }

    .stat-num {
        font-size: 20px;
        font-weight: 600;
        color: #111;
        line-height: 1;
        margin-bottom: 3px;
    }
    .stat-label {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: #9c9c99;
    }

    .field-label {
        font-size: 11px !important;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #6b6b68 !important;
        margin-bottom: 6px;
    }

    .field-input {
        font-size: 14px;
        background: #f7f6f3 !important;
        border-color: rgba(0,0,0,0.12) !important;
        border-radius: 9px !important;
        padding: 10px 14px;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .field-input:focus {
        border-color: #c2410c !important;
        box-shadow: 0 0 0 3px rgba(194,65,12,0.08) !important;
        background: #fff !important;
    }
    .field-input:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .post-card {
        transition: transform 0.15s, border-color 0.15s;
    }
    .post-card:hover {
        transform: translateY(-2px);
        border-color: rgba(0,0,0,0.18) !important;
    }
</style>

@endsection