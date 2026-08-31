<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);

        return view('dashboard.post', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (! $post) {
            return redirect()->route('dashboard.post')->with('error', 'Post not found.');
        }

        return view('dashboard.post', compact('post'));
    }

    public function addPost()
    {
        return view('dashboard.addpost');
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'category_id' => $validatedData['category_id'],
        ]);

        return redirect()->route('dashboard.post')->with('success', 'Post created successfully.');
    }

    public function editPost($id)
    {
        $post = Post::find($id);

        if (! $post) {
            return redirect()->route('dashboard.post')->with('error', 'Post not found.');
        }

        return view('dashboard.editpost', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (! $post) {
            return redirect()->route('dashboard.post')->with('error', 'Post not found.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'category_id' => $validatedData['category_id'],
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
