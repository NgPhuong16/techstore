@extends('admin.adminlayout')
@section('admin-content')
<div class="container-fluid">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="my-3">
        @include('profile.partials.update-profile-information-form')
    </div>
    <div class="my-3">
        @include('profile.partials.update-password-form')
    </div>
    <div class="my-3">
        @include('profile.partials.delete-user-form')
    </div>
    
               
               
               
</div> 
@endsection
            
