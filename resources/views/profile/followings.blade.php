@extends('layout.main')

@section('content')

<div class="container py-5" style="max-width: 760px;">

    <!-- Header -->
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">

        <div>
            <h2 class="fw-semibold mb-1" style="font-size:26px;">
                Following
            </h2>

            <p class="mb-0" style="font-size:13px; color:#8b8b87;">
                People this profile follows
            </p>
        </div>

        <div class="following-count-card">
            <span>Total</span>
            <strong>{{ $followingsCount }}</strong>
        </div>

    </div>

    <!-- Search -->
    <div class="mb-4">
        <input type="text"
            class="form-control following-search"
            placeholder="Search following...">
    </div>

    <!-- Following List -->
    <div class="d-flex flex-column gap-3">

        @forelse ($followings as $following)

        <div class="following-card">

            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">

                <!-- following -->
                <a href="{{ route('profile.target', $following) }}"
                    class="d-flex align-items-center gap-3 text-decoration-none flex-grow-1">

                    <!-- Avatar -->
                    <div class="following-avatar">
                        {{ strtoupper(substr($following->name, 0, 1)) }}
                    </div>

                    <!-- Info -->
                    <div class="overflow-hidden">

                        <h6 class="mb-1 text-dark fw-semibold text-truncate"
                            style="font-size:15px;">
                            {{ $following->name }}
                        </h6>

                        <p class="mb-0 text-truncate"
                            style="font-size:12px; color:#8b8b87;">
                            {{ $following->email }}
                        </p>

                    </div>

                </a>

                <!-- Button -->
                @if ($following->id != Auth::id())
                    <button class="following-btn" data-user_id="{{ $following->id }}">
                        {{ $following->is_Followed_current_user? "Unfollow": "Follow"}}
                    </button>
                @endif

            </div>

        </div>

        @empty

        <div class="text-center py-5">

            <div style="font-size:40px;">
                👤
            </div>

            <h5 class="fw-semibold mt-3 mb-1"
                style="color:#4b4b48;">
                No following yet
            </h5>

            <p style="font-size:13px; color:#8b8b87;">
                This profile is not following anyone yet.
            </p>

        </div>

        @endforelse

    </div>

</div>

<style>
    .following-count-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 18px;
        padding: 10px 18px;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 85px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }

    .following-count-card span {
        font-size: 11px;
        color: #8b8b87;
    }

    .following-count-card strong {
        font-size: 22px;
        color: #c2410c;
        line-height: 1.1;
    }

    .following-search {
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.08);
        padding: 12px 16px;
        font-size: 13px;
        box-shadow: none !important;
    }

    .following-search:focus {
        border-color: #c2410c;
    }

    .following-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 22px;
        padding: 18px;
        transition: 0.15s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }

    .following-card:hover {
        transform: translateY(-2px);
        border-color: rgba(0,0,0,0.12);
    }

    .following-avatar {
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

    .following-btn {
        border: 1px solid #c2410c;
        background: transparent;
        color: #c2410c;
        border-radius: 999px;
        padding: 7px 18px;
        font-size: 12px;
        font-weight: 500;
        transition: 0.15s ease;
    }

    .following-btn:hover {
        background: #c2410c;
        color: white;
    }
</style>
<script>
    document.querySelectorAll('.following-btn').forEach(button => {
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
                    btn.innerText = data.followed ? 'Unfollow' : 'Follow';
                });
        });
    });
</script>
@endsection