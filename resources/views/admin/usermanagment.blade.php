@extends('layouts.app')

@section('title', 'dashboard')

@section('content')

<section class="dashboard">
    <div class="container dashboard__container">

        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>

        @include('admin.partials.sidebar')

        <main>
            <h2>Manage Users</h2>

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

            <form action="{{ route('dashboard.user.search') }}" method="GET" class="search__form">
                <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}">
                <button type="submit" class="btn">Search</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td><a href="{{ route('dashboard.edituser', $user) }}" class="btn sm">Edit</a></td>
                            <td>
                                <form action="{{ route('dashboard.deleteuser', $user) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn sm danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $users->links() }}
        </main>
    </div>
</section>

@endsection