@extends('layouts.app')

@section('title', 'dashboard')

@section('content')

<section class="dashboard">
    <div class="container dashboard__container">

        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>

        @include('admin.partials.sidebar')

        <main>
            <h2>Manage Categories</h2>

            @if (session('success'))
                <div class="alert__message success">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="alert__message error">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->description }}</td>
                            <td><a href="{{ route('dashboard.editcategory', $category) }}" class="btn sm">Edit</a></td>
                            <td>
                                <form action="{{ route('dashboard.deletecategory', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn sm danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $categories->links() }}
        </main>
    </div>
</section>

@endsection