@extends('user.layout')
@section('namepage','login')
@section('maincontent')
<!-- Start Account Register Area -->
<div class="account-login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                <div class="register-form">
                    <div class="title">
                        <h3>No Account? Register</h3>
                        <p>Registration takes less than a minute but gives you full control over your orders.</p>
                    </div>
                    <form class="row" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{-- <label for="name">Full Name</label>
                                <input class="form-control" type="text" id="name" required> --}}
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus  />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{-- <label for="phone">Phone Number</label>
                                <input class="form-control" type="text" id="phone" required> --}}
                                <x-input-label for="phone_number" :value="__('Phone Number')" />
                                <x-text-input id="phone_number" class="form-control" type="text" name="phone_number" :value="old('phone_number')" required autofocus  />
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{-- <label for="email">E-mail Address</label>
                                <input class="form-control" type="email" id="email" required> --}}
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required  />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{-- <label for="address">Address</label>
                                <input class="form-control" type="text" id="address" required> --}}
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input id="address" class="form-control" type="text" name="address" :value="old('address')" required autofocus  />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{-- <label for="pass">Password</label>
                                <input class="form-control" type="password" id="pass" required> --}}
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="form-control"
                                                type="password"
                                                name="password"
                                                required  />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{-- <label for="pass-confirm">Confirm Password</label>
                                <input class="form-control" type="password" id="pass-confirm" required> --}}
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" class="form-control"
                                                type="password"
                                                name="password_confirmation" required />
                
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                        <div class="button">
                            <button class="btn" type="submit">Register</button>
                        </div>
                        <p class="outer-link">Already have an account? <a href="{{route('login')}}">Login Now</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Account Register Area -->
@endsection
