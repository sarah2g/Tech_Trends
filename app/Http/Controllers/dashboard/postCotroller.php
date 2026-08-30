<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class postCotroller extends Controller
{
    public function index()
    {
        $posts = Post::all()->paginate(10);
        return view('dashboard.post', compact('posts'));
    }
    public function show($id)
    {
        // Logic to retrieve post data based on the provided ID
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('dashboard.post')->with('error', 'Post not found.');
        }

        return view('dashboard.post', compact('post'));
    }
    public function create()
    {
        return view('dashboard.addpost');
    }
    public function store(Request $request){
        $post = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);
        Post::create([
            'title' => $post['title'],
            'content' => $post['content'],
            'category_id' => $post['category_id'],
        ]);
        return redirect()->route('dashboard.post')->with('success', 'Post created successfully.');
    }
    public function edit($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('dashboard.post')->with('error', 'Post not found.');
        }

        return view('dashboard.editpost', compact('post'));
    }
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('dashboard.post')->with('error', 'Post not found.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update([
            'title' => $data['title'],
            'content' => $data['content'],
            'category_id' => $data['category_id'],
        ]);

        return redirect()->route('dashboard.post')->with('success', 'Post updated successfully.');
    }
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('dashboard.post')->with('error', 'Post not found.');
        }

        $post->delete();

        return redirect()->route('dashboard.post')->with('success', 'Post deleted successfully.');
    }
}
