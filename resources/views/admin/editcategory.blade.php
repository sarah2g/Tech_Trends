@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')

<section class="form__section">

    <div class="container form__section-container">
        <a href="{{ route('dashboard.category') }}" class="form__back"><i class="uil uil-arrow-left"></i> Back to Categories</a>
        <h2>Edit Category</h2>

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

        <form action="{{ route('dashboard.update.category', $category) }}" method="POST">
            @csrf
            <x-form-control field="title" label="Title">
                <input type="text" name="title" placeholder="e.g. Web Development" value="{{ old('title', $category->title) }}">
            </x-form-control>

            <x-form-control field="description" label="Description">
                <textarea name="description" rows="4" placeholder="A short description for this category">{{ old('description', $category->description) }}</textarea>
            </x-form-control>

            <div class="form__actions">
                <button type="submit" class="btn">Edit Category</button>
                <a href="{{ route('dashboard.category') }}" class="form__cancel">Cancel</a>
            </div>
        </form>
    </div>

</section>

@endsection