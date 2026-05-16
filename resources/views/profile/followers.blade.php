@extends('layout.main')

@section('content')

<div class="container py-5" style="max-width: 760px;">

    <!-- Header -->
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <h2 class="fw-semibold mb-1" style="font-size:26px;">
                Followers
            </h2>

            <p class="mb-0" style="font-size:13px; color:#8b8b87;">
                People following this profile
            </p>
        </div>

        <div class="followers-count-card">
            <span>Total</span>
            <strong>{{ count($followers) }}</strong>
        </div>
    </div>

    <!-- Search -->
    <div class="mb-4">
        <input type="text" class="form-control followers-search" placeholder="Search followers...">
    </div>

    <!-- Followers List -->
    <div class="d-flex flex-column gap-3">

        @forelse ($followers as $user)

        <div class="follower-card">

            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">

                <!-- Left -->
                <a href="{{ route('profile.target', $user) }}"
                    class="text-decoration-none d-flex align-items-center gap-3 flex-grow-1">

                    <!-- Avatar -->
                    <div class="follower-avatar">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <!-- Info -->
                    <div class="overflow-hidden">

                        <h6 class="mb-1 text-dark fw-semibold text-truncate" style="font-size:15px;">
                            {{ $user->name }}
                        </h6>

                        <p class="mb-0 text-truncate" style="font-size:12px; color:#8b8b87;">
                            {{ $user->email }}
                        </p>

                    </div>

                </a>

                <!-- Follow Button -->
                @if ($user->id != Auth::id())
                <button class="follow-btn" data-user_id="{{ $user->id }}">
                    {{ $user->is_Followed_current_user?"Unfollow":"Follow" }}
                </button>
                @endif

            </div>

        </div>

        @empty

        <div class="text-center py-5">

            <div style="font-size:40px;">
                👥
            </div>

            <h5 class="fw-semibold mt-3 mb-1" style="color:#4b4b48;">
                No followers yet
            </h5>

            <p style="font-size:13px; color:#8b8b87;">
                When people follow this profile, they'll appear here.
            </p>

        </div>

        @endforelse

    </div>

</div>

<style>
    .followers-count-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-radius: 18px;
        padding: 10px 18px;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 85px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .followers-count-card span {
        font-size: 11px;
        color: #8b8b87;
    }

    .followers-count-card strong {
        font-size: 22px;
        color: #c2410c;
        line-height: 1.1;
    }

    .followers-search {
        border-radius: 16px;
        border: 1px solid rgba(0, 0, 0, 0.08);
        padding: 12px 16px;
        font-size: 13px;
        box-shadow: none !important;
    }

    .followers-search:focus {
        border-color: #c2410c;
    }

    .follower-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-radius: 22px;
        padding: 18px;
        transition: 0.15s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .follower-card:hover {
        transform: translateY(-2px);
        border-color: rgba(0, 0, 0, 0.12);
    }

    .follower-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: #fde8dc;
        color: #c2410c;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 600;
        flex-shrink: 0;
    }

    .follow-btn {
        border: 1px solid #c2410c;
        background: transparent;
        color: #c2410c;
        border-radius: 999px;
        padding: 7px 18px;
        font-size: 12px;
        font-weight: 500;
        transition: 0.15s ease;
    }

    .follow-btn:hover {
        background: #c2410c;
        color: white;
    }
</style>
<script>
    document.querySelectorAll('.follow-btn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.user_id;
            const btn = this;
            fetch(`/users/${userId}/follow`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data.followed);
                    
                    btn.innerText = data.followed ? 'Unfollow' : 'Follow';
                });
        });
    });
</script>
@endsection