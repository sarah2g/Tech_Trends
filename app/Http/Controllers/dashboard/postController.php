<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->paginate(10);

        return view('admin.dashboard', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::with('category')->find($id);

        if (! $post) {
            return redirect()->route('dashboard.post')->with('error', 'Post not found.');
        }

        return view('admin.dashboard', compact('post'));
    }

    public function addPost()
    {
        $categories = Category::orderBy('title')->get();

        return view('admin.addpost', compact('categories'));
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'sometimes|boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $thumbnailPath = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Post::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'category_id' => $validatedData['category_id'],
            'is_featured' => $request->boolean('is_featured'),
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('dashboard.post')->with('success', 'Post created successfully.');
    }

    public function editPost($id)
    {
        $post = Post::with('category')->find($id);

        if (! $post) {
            return redirect()->route('dashboard.post')->with('error', 'Post not found.');
        }

        $categories = Category::orderBy('title')->get();

        return view('admin.editpost', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (! $post) {
            return redirect()->route('dashboard.post')->with('error', 'Post not found.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'sometimes|boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $thumbnailPath = $post->thumbnail;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $post->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'category_id' => $validatedData['category_id'],
            'is_featured' => $request->boolean('is_featured'),
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('dashboard.post')->with('success', 'Post updated successfully.');
    }

    public function delete($id)
    {
        $post = Post::find($id);

        if (! $post) {
            return redirect()->route('dashboard.post')->with('error', 'Post not found.');
        }

        $post->delete();

        return redirect()->route('dashboard.post')->with('success', 'Post deleted successfully.');
    }
}
