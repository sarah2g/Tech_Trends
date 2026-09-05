@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

<section class="form__section">
    <div class="container form__section-container">
        <a href="{{ route('dashboard.post') }}" class="form__back"><i class="uil uil-arrow-left"></i> Back to Posts</a>
        <h2>Edit Post</h2>

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

        <form action="{{ route('dashboard.update.post', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form-control field="title" label="Title">
                <input type="text" name="title" placeholder="e.g. Exploring the World" value="{{ old('title', $post->title) }}">
            </x-form-control>

            <x-form-control field="category_id" label="Category">
                <select name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->title }}</option>
                    @endforeach
                </select>
            </x-form-control>

            <x-form-control field="is_featured" class="inline">
                <input type="checkbox" name="is_featured" @checked(old('is_featured', $post->is_featured))>
                <label for="is_featured">Featured</label>
            </x-form-control>

            <x-form-control field="body" label="Body">
                <textarea name="body" rows="8" placeholder="Write your post content here">{{ old('body', $post->body) }}</textarea>
            </x-form-control>

            <x-form-control field="thumbnail" label="Thumbnail">
                <input type="file" name="thumbnail">
            </x-form-control>

            <div class="form__actions">
                <button type="submit" class="btn">Edit Post</button>
                <a href="{{ route('dashboard.post') }}" class="form__cancel">Cancel</a>
            </div>
        </form>
    </div>
</section>

@endsection