@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<section class="form__section">
    <div class="container form__section-container">
        <a href="{{ route('dashboard.user') }}" class="form__back"><i class="uil uil-arrow-left"></i> Back to Users</a>
        <h2>Edit User</h2>

        @if ($errors->any())
            <div class="alert__message error">
                <p>{{ __('Please fix the issues below and try again.') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="alert__message error">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <form action="{{ route('dashboard.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form-control field="firstname" label="First Name">
                <input type="text" name="firstname" placeholder="Jane" value="{{ old('firstname', $user->firstname) }}">
            </x-form-control>

            <x-form-control field="lastname" label="Last Name">
                <input type="text" name="lastname" placeholder="Doe" value="{{ old('lastname', $user->lastname) }}">
            </x-form-control>

            <x-form-control field="username" label="Username">
                <input type="text" name="username" placeholder="janedoe" value="{{ old('username', $user->username) }}">
            </x-form-control>

            <x-form-control field="email" label="Email">
                <input type="email" name="email" placeholder="jane@example.com" value="{{ old('email', $user->email) }}">
            </x-form-control>

            <x-form-control field="password" label="New Password">
                <input type="password" name="password" placeholder="Leave blank to keep current password">
            </x-form-control>

            <x-form-control field="password_confirmation" label="Confirm New Password">
                <input type="password" name="password_confirmation" placeholder="Repeat the new password">
            </x-form-control>

            <x-form-control field="role" label="Role">
                <select name="role">
                    @foreach (['author', 'admin', 'user'] as $role)
                        <option value="{{ $role }}" @selected(old('role', $user->role) === $role)>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </x-form-control>

            <x-form-control field="user_avatar" label="User Avatar">
                <input type="file" name="user_avatar">
            </x-form-control>

            <div class="form__actions">
                <button type="submit" class="btn">Edit User</button>
                <a href="{{ route('dashboard.user') }}" class="form__cancel">Cancel</a>
            </div>
        </form>
    </div>
</section>

@endsection