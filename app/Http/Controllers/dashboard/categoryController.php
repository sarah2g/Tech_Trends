<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);

        return view('admin.categorymanagment', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return redirect()->route('dashboard.category')->with('error', 'Category not found.');
        }

        return view('admin.categorymanagment', compact('category'));
    }

    public function addCategory()
    {
        return view('admin.addcategory');
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:categories,title',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'] ?? null,
        ]);

        return redirect()->route('dashboard.category')->with('success', 'Category added successfully.');
    }

    public function editCategory($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return redirect()->route('dashboard.category')->with('error', 'Category not found.');
        }

        return view('admin.editcategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (! $category) {
            return redirect()->route('dashboard.category')->with('error', 'Category not found.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:categories,title,'.$category->id,
            'description' => 'nullable|string',
        ]);

        $category->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'] ?? null,
        ]);

        return redirect()->route('dashboard.category')->with('success', 'Category updated successfully.');
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return redirect()->route('dashboard.category')->with('error', 'Category not found.');
        }

        $category->delete();

        return redirect()->route('dashboard.category')->with('success', 'Category deleted successfully.');
    }
}
