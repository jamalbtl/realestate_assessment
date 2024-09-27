@extends('layouts.default')

@section('content')
<div class="col-md-6">
    <div class="card">
        @if(session('status') === 'profile-updated')
            <div class="alert alert-success"> {{ __('Profile Updated') }}</div>
        @endif
        <div class="card-body">
            <h4 class="card-title">Profile</h4>
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>
            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label for="name">Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{old('name', $user->name)}}" placeholder="Enter Your Full Name">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
               
                <div class="form-group">
                    <label for="email">Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" id="email" value="{{old('email', $user->email)}}" placeholder="Email">
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                {{ __('Your email address is unverified.') }}
        
                                <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>
        
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary me-2">Update</button>
                {{-- @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >{{ __('Saved.') }}</p>
                @endif --}}
            </form>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card">
        @if (session('status')==='password-updated')
            <div class="alert alert-success"> {{ __('Password Updated') }}</div>
        @endif
        <div class="card-body">
            <h4 class="card-title">Update Password</h4>
            
            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="update_password_current_password">Current Password</label>
                    <input id="update_password_current_password" name="current_password" type="password" class="form-control">
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>
               
                <div class="form-group">
                    <label for="update_password_password">New Password</label>
                    <input id="update_password_password" name="password" type="password" class="form-control">
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <div class="form-group">
                    <label for="update_password_password_confirmation">Confirm Password</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control">
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>
                <button type="submit" class="btn btn-primary me-2">Update</button>
                
            </form>
        </div>
    </div>
</div>
@endsection

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
