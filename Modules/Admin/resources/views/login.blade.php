@extends('admin::layouts.auth')

@section('title', 'Admin Login')

@section('content')
<div style="display:flex;min-height:100vh;">

    {{-- ── Left panel: brand ─────────────────────────────────────────────── --}}
    <div class="hidden lg:flex lg:flex-col lg:justify-between" style="
        width: 45%;
        flex-shrink: 0;
        background: linear-gradient(145deg, #0f1c3f 0%, #1a3270 50%, #1e4db7 100%);
        padding: 3rem;
        position: relative;
        overflow: hidden;
    ">
        {{-- Decorative orbs --}}
        <div style="position:absolute;top:-80px;right:-80px;width:300px;height:300px;border-radius:50%;
            background:rgba(255,255,255,0.04);pointer-events:none;"></div>
        <div style="position:absolute;bottom:-120px;left:-60px;width:400px;height:400px;border-radius:50%;
            background:rgba(255,255,255,0.03);pointer-events:none;"></div>
        <div style="position:absolute;top:40%;left:55%;width:180px;height:180px;border-radius:50%;
            background:rgba(99,163,255,0.08);pointer-events:none;"></div>

        {{-- Logo --}}
        <div style="position:relative;z-index:1;">
            <div style="display:inline-flex;align-items:center;gap:12px;">
                <div style="
                    width:44px;height:44px;border-radius:12px;
                    background:rgba(255,255,255,0.15);
                    display:flex;align-items:center;justify-content:center;
                    font-size:20px;font-weight:800;color:#fff;
                    border:1px solid rgba(255,255,255,0.2);
                    backdrop-filter:blur(4px);
                ">E</div>
                <span style="font-size:20px;font-weight:700;color:#fff;letter-spacing:-0.3px;">Eureka Admin</span>
            </div>
        </div>

        {{-- Centre copy --}}
        <div style="position:relative;z-index:1;flex:1;display:flex;flex-direction:column;justify-content:center;padding:2rem 0;">
            <div style="
                display:inline-flex;align-items:center;gap:8px;
                background:rgba(255,255,255,0.1);
                border:1px solid rgba(255,255,255,0.15);
                border-radius:999px;
                padding:6px 14px;
                width:fit-content;
                margin-bottom:1.5rem;
            ">
                <div style="width:8px;height:8px;border-radius:50%;background:#4ade80;flex-shrink:0;
                    box-shadow:0 0 6px rgba(74,222,128,.7);"></div>
                <span style="font-size:12px;font-weight:600;color:rgba(255,255,255,.85);letter-spacing:.3px;">
                    Admin Control Panel
                </span>
            </div>

            <h1 style="font-size:2.5rem;font-weight:800;color:#fff;line-height:1.15;margin:0 0 1rem;letter-spacing:-0.5px;">
                Manage everything<br>in one place.
            </h1>
            <p style="font-size:0.95rem;color:rgba(255,255,255,.6);line-height:1.7;margin:0 0 2.5rem;max-width:340px;">
                Users, subscriptions, credit plans, exams, competitions and more — all at your fingertips.
            </p>

            {{-- Feature list --}}
            <div style="display:flex;flex-direction:column;gap:14px;">
                @foreach([
                    ['mgc_group_line',       'Users & Subscriptions'],
                    ['mgc_bank_card_line',   'Billing & Credit Plans'],
                    ['mgc_clipboard_line',   'Exams & Competitions'],
                    ['mgc_notification_line','Push Notifications'],
                ] as [$icon, $label])
                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="
                        width:36px;height:36px;border-radius:10px;flex-shrink:0;
                        background:rgba(255,255,255,0.08);
                        border:1px solid rgba(255,255,255,0.12);
                        display:flex;align-items:center;justify-content:center;
                    ">
                        <i class="{{ $icon }}" style="font-size:16px;color:rgba(255,255,255,.8);"></i>
                    </div>
                    <span style="font-size:14px;font-weight:500;color:rgba(255,255,255,.75);">{{ $label }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Footer --}}
        <div style="position:relative;z-index:1;">
            <p style="font-size:12px;color:rgba(255,255,255,.35);margin:0;">
                &copy; {{ date('Y') }} Eureka EdTech. All rights reserved.
            </p>
        </div>
    </div>

    {{-- ── Right panel: form ──────────────────────────────────────────────── --}}
    <div style="flex:1;display:flex;align-items:center;justify-content:center;padding:2rem;background:#f8fafc;" class="dark:bg-gray-900">
        <div style="width:100%;max-width:420px;">

            {{-- Mobile logo (hidden on lg) --}}
            <div class="lg:hidden text-center mb-8">
                <div style="
                    display:inline-flex;align-items:center;justify-content:center;
                    width:52px;height:52px;border-radius:14px;
                    background:linear-gradient(135deg,#3b88ff,#1e5fd4);
                    font-size:22px;font-weight:800;color:#fff;
                    box-shadow:0 8px 20px rgba(59,136,255,.35);
                    margin-bottom:12px;
                ">E</div>
                <h4 style="font-size:1.25rem;font-weight:700;color:#1a202c;margin:0 0 4px;">Admin Sign In</h4>
                <p style="font-size:13px;color:#8a94a6;margin:0;">Enter your credentials to continue</p>
            </div>

            {{-- Heading (desktop) --}}
            <div class="hidden lg:block mb-8">
                <h2 style="font-size:1.75rem;font-weight:800;color:#1a202c;margin:0 0 6px;letter-spacing:-0.3px;">
                    Welcome back
                </h2>
                <p style="font-size:14px;color:#8a94a6;margin:0;">Sign in to your admin account</p>
            </div>

            {{-- Errors --}}
            @if($errors->any())
                <div style="
                    margin-bottom:20px;padding:14px 16px;border-radius:10px;
                    background:#fff5f5;border:1px solid #fed7d7;
                " class="dark:bg-red-900/20 dark:border-red-800">
                    @foreach($errors->all() as $error)
                        <p style="display:flex;align-items:center;gap:8px;margin:0;font-size:13px;color:#c53030;">
                            <i class="mgc_close_circle_line" style="flex-shrink:0;"></i> {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            @if(session('error'))
                <div style="
                    margin-bottom:20px;padding:14px 16px;border-radius:10px;
                    background:#fff5f5;border:1px solid #fed7d7;font-size:13px;color:#c53030;
                ">{{ session('error') }}</div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.login.send') }}" method="POST" novalidate>
                @csrf

                {{-- Email --}}
                <div style="margin-bottom:18px;">
                    <label for="email" style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;">
                        Email Address
                    </label>
                    <div style="position:relative;">
                        <i class="mgc_mail_line" style="
                            position:absolute;left:14px;top:50%;transform:translateY(-50%);
                            font-size:16px;color:#9ca3af;pointer-events:none;
                        "></i>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            autocomplete="username"
                            autofocus
                            placeholder="admin@example.com"
                            style="
                                width:100%;box-sizing:border-box;
                                height:48px;padding:0 14px 0 42px;
                                border:1.5px solid {{ $errors->has('email') ? '#fc8181' : '#e4e8f0' }};
                                border-radius:12px;font-size:14px;color:#1a202c;
                                background:#fff;outline:none;
                                transition:border-color .15s;
                            "
                            onfocus="this.style.borderColor='#3b88ff'"
                            onblur="this.style.borderColor='{{ $errors->has('email') ? '#fc8181' : '#e4e8f0' }}'">
                    </div>
                </div>

                {{-- Password --}}
                <div style="margin-bottom:28px;">
                    <label for="password" style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;">
                        Password
                    </label>
                    <div style="position:relative;">
                        <i class="mgc_lock_line" style="
                            position:absolute;left:14px;top:50%;transform:translateY(-50%);
                            font-size:16px;color:#9ca3af;pointer-events:none;
                        "></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            autocomplete="current-password"
                            placeholder="••••••••"
                            style="
                                width:100%;box-sizing:border-box;
                                height:48px;padding:0 44px 0 42px;
                                border:1.5px solid {{ $errors->has('password') ? '#fc8181' : '#e4e8f0' }};
                                border-radius:12px;font-size:14px;color:#1a202c;
                                background:#fff;outline:none;
                                transition:border-color .15s;
                            "
                            onfocus="this.style.borderColor='#3b88ff'"
                            onblur="this.style.borderColor='{{ $errors->has('password') ? '#fc8181' : '#e4e8f0' }}'">
                        <button type="button" id="togglePwd" style="
                            position:absolute;right:14px;top:50%;transform:translateY(-50%);
                            background:none;border:none;cursor:pointer;padding:4px;color:#9ca3af;
                        ">
                            <i class="mgc_eye_close_line" id="eyeIcon" style="font-size:18px;"></i>
                        </button>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" style="
                    width:100%;height:50px;border:none;border-radius:13px;cursor:pointer;
                    font-size:15px;font-weight:700;color:#fff;letter-spacing:.3px;
                    background:linear-gradient(135deg,#3b88ff 0%,#1e5fd4 100%);
                    box-shadow:0 6px 20px rgba(59,136,255,.4);
                    transition:opacity .15s,box-shadow .15s;
                "
                onmouseover="this.style.opacity='.9'"
                onmouseout="this.style.opacity='1'">
                    Sign In
                </button>
            </form>

            <p style="text-align:center;font-size:12px;color:#b0b8c9;margin-top:32px;">
                &copy; {{ date('Y') }} Eureka EdTech &mdash; Admin access only
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('togglePwd').addEventListener('click', function () {
        var pwd  = document.getElementById('password');
        var icon = document.getElementById('eyeIcon');
        if (pwd.type === 'password') {
            pwd.type = 'text';
            icon.className = 'mgc_eye_line';
        } else {
            pwd.type = 'password';
            icon.className = 'mgc_eye_close_line';
        }
    });
</script>
@endpush

@endsection
