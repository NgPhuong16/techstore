@extends('user.layout')
@section('namepage','login')
@section('maincontent')
<div class="account-login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                <form class="card login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card-body">
                        <div class="title">
                            <h3>Login Now</h3>
                            <p>You can login using your social media account or email address.</p>
                        </div>
                        <div class="social-login">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12"><a class="btn facebook-btn"
                                        href="javascript:void(0)"><i class="lni lni-facebook-filled"></i> Facebook
                                        login</a></div>
                                <div class="col-lg-4 col-md-4 col-12"><a class="btn twitter-btn"
                                        href="javascript:void(0)"><i class="lni lni-twitter-original"></i> Twitter
                                        login</a></div>
                                <div class="col-lg-4 col-md-4 col-12"><a class="btn google-btn"
                                        href="javascript:void(0)"><i class="lni lni-google"></i> Google login</a>
                                </div>
                            </div>
                        </div>
                        <div class="alt-option">
                            <span>Or</span>
                        </div>
                        <div class="form-group input-group">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                        </div>
                        <div class="form-group input-group">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="form-control"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                        </div>
                        <div class="d-flex flex-wrap justify-content-between bottom-content">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="form-check-input width-auto" name="remember">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a class="lost-pass" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="button">
                            <button class="btn" type="submit">Login</button>
                        </div>
                        <p class="outer-link">Don't have an account? <a href="{{route('register')}}">Register here </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
