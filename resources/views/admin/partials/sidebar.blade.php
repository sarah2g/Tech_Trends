<aside>
    <ul>
        <li>
            <a href="{{ route('dashboard.addpost') }}" class="{{ request()->routeIs('dashboard.addpost', 'dashboard.editpost') ? 'active' : '' }}">
                <i class="uil uil-pen"></i>
                <h5>Add Post</h5>
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard.post') }}" class="{{ request()->routeIs('dashboard.post') ? 'active' : '' }}">
                <i class="uil uil-postcard"></i>
                <h5>Manage Posts</h5>
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard.adduser') }}" class="{{ request()->routeIs('dashboard.adduser', 'dashboard.edituser') ? 'active' : '' }}">
                <i class="uil uil-user-plus"></i>
                <h5>Add User</h5>
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard.user') }}" class="{{ request()->routeIs('dashboard.user', 'dashboard.user.search') ? 'active' : '' }}">
                <i class="uil uil-users-alt"></i>
                <h5>Manage Users</h5>
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard.addcategory') }}" class="{{ request()->routeIs('dashboard.addcategory', 'dashboard.editcategory') ? 'active' : '' }}">
                <i class="uil uil-edit"></i>
                <h5>Add Category</h5>
            </a>
        </li>

        <li>
            <a href="{{ route('dashboard.category') }}" class="{{ request()->routeIs('dashboard.category') ? 'active' : '' }}">
                <i class="uil uil-list-ul"></i>
                <h5>Manage Categories</h5>
            </a>
        </li>
    </ul>
</aside>