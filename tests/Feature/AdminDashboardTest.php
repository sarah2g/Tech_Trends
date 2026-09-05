<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

it('renders the manage pages for an admin', function () {
    $admin = User::factory()->create(['role' => 'admin', 'email_verified_at' => now()]);
    Category::factory()->count(3)->create();
    Post::factory()->count(3)->create();

    $this->actingAs($admin)->get(route('dashboard.post'))->assertOk()->assertSee('Manage Posts');
    $this->actingAs($admin)->get(route('dashboard.category'))->assertOk()->assertSee('Manage Categories');
    $this->actingAs($admin)->get(route('dashboard.user'))->assertOk()->assertSee('Manage Users');
});

it('renders the add pages for an admin', function () {
    $admin = User::factory()->create(['role' => 'admin', 'email_verified_at' => now()]);
    Category::factory()->create();

    $this->actingAs($admin)->get(route('dashboard.addpost'))->assertOk()->assertSee('Add Post');
    $this->actingAs($admin)->get(route('dashboard.addcategory'))->assertOk()->assertSee('Add Category');
    $this->actingAs($admin)->get(route('dashboard.adduser'))->assertOk()->assertSee('Add User');
});

it('renders the edit pages for an admin', function () {
    $admin = User::factory()->create(['role' => 'admin', 'email_verified_at' => now()]);
    $category = Category::factory()->create();
    $post = Post::factory()->create(['category_id' => $category->id]);
    $user = User::factory()->create();

    $this->actingAs($admin)->get(route('dashboard.editpost', $post))->assertOk()->assertSee('Edit Post');
    $this->actingAs($admin)->get(route('dashboard.editcategory', $category))->assertOk()->assertSee('Edit Category');
    $this->actingAs($admin)->get(route('dashboard.edituser', $user))->assertOk()->assertSee('Edit User');
});

it('forbids users with the role user from the admin area', function () {
    $user = User::factory()->create(['role' => 'user', 'email_verified_at' => now()]);

    $this->actingAs($user)->get(route('dashboard.post'))->assertForbidden();
});

it('creates a category from the add form', function () {
    $admin = User::factory()->create(['role' => 'admin', 'email_verified_at' => now()]);

    $this->actingAs($admin)->post(route('dashboard.addcategory.post'), [
        'title' => 'Gaming',
        'description' => 'All about games',
    ])->assertRedirect(route('dashboard.category'));

    $this->assertDatabaseHas('categories', ['title' => 'Gaming']);
});

it('creates a post from the add form', function () {
    $admin = User::factory()->create(['role' => 'admin', 'email_verified_at' => now()]);
    $category = Category::factory()->create();

    $this->actingAs($admin)->post(route('dashboard.addpost.post'), [
        'title' => 'My first post',
        'body' => 'Some content here',
        'category_id' => $category->id,
    ])->assertRedirect(route('dashboard.post'));

    $this->assertDatabaseHas('posts', ['title' => 'My first post', 'body' => 'Some content here']);
});

it('updates a post from the edit form', function () {
    $admin = User::factory()->create(['role' => 'admin', 'email_verified_at' => now()]);
    $category = Category::factory()->create();
    $post = Post::factory()->create(['category_id' => $category->id]);

    $this->actingAs($admin)->post(route('dashboard.update.post', $post), [
        'title' => 'Updated title',
        'body' => 'Updated body',
        'category_id' => $category->id,
    ])->assertRedirect(route('dashboard.post'));

    $this->assertDatabaseHas('posts', ['id' => $post->id, 'title' => 'Updated title', 'body' => 'Updated body']);
});

it('adds a user from the add form', function () {
    $admin = User::factory()->create(['role' => 'admin', 'email_verified_at' => now()]);

    $this->actingAs($admin)->post(route('dashboard.adduser.post'), [
        'firstname' => 'Jane',
        'lastname' => 'Doe',
        'username' => 'janedoe',
        'email' => 'jane@example.com',
        'role' => 'author',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertRedirect(route('dashboard.user'));

    $this->assertDatabaseHas('users', ['username' => 'janedoe', 'role' => 'author']);
});

it('deletes a user from the manage page', function () {
    $admin = User::factory()->create(['role' => 'admin', 'email_verified_at' => now()]);
    $user = User::factory()->create();

    $this->actingAs($admin)->delete(route('dashboard.deleteuser', $user))->assertRedirect(route('dashboard.user'));

    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});
