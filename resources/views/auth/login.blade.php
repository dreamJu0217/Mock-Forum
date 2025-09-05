@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('লগইন') }}</div>

                <div class="card-body">
                    <!-- User Login Form -->
                    <form id="user-login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- User Login Fields -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('ইমেইল') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('পাসওয়ার্ড') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('মনে রাখুন') }}
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" style="background-color: rgb(185,168,214); 
                            /* border: 1px solid rgb(23, 11, 29); */
                            color: white;
                            padding: 3px 10px;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 16px;
                            cursor: pointer;">লগইন
                        </button>
                    </form>

                    <!-- Admin Login Form (hidden by default) -->
                    <form id="admin-login-form" method="POST" action="{{ route('admin.login.submit') }}" style="display: none;">
                        @csrf
                        <!-- Admin Login Fields -->
                        <div class="mb-3">
                            <label for="admin-email" class="form-label">{{ __('অ্যাডমিন ইমেইল') }}</label>
                            <input id="admin-email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
 
                        <!-- Admin Password Field -->
                        <div class="mb-3">
                            <label for="admin-password" class="form-label">{{ __('অ্যাডমিন পাসওয়ার্ড') }}</label>
                            <input id="admin-password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Submit Button for Admin Login -->
                        <button type="submit" class="btn btn-primary">{{ __(' লগইন') }}</button>
                    </form>

                    <!-- Toggle Button -->
                    <button id="toggle-login-btn" class="btn btn-secondary mt-3">অ্যাডমিন লগইন</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const userLoginForm = document.getElementById('user-login-form');
        const adminLoginForm = document.getElementById('admin-login-form');
        const toggleLoginBtn = document.getElementById('toggle-login-btn');

        // Initially hide the admin login form
        adminLoginForm.style.display = 'none';

        // Event listener for toggle button
        toggleLoginBtn.addEventListener('click', function() {
            if (adminLoginForm.style.display === 'none') {
                // Switch to admin login
                adminLoginForm.style.display = 'block';
                userLoginForm.style.display = 'none';
                toggleLoginBtn.textContent = 'ইউজার লগইন';
            } else {
                // Switch to user login
                adminLoginForm.style.display = 'none';
                userLoginForm.style.display = 'block';
                toggleLoginBtn.textContent = 'অ্যাডমিন লগইন';
            }
        });
    });
</script>

@endsection
