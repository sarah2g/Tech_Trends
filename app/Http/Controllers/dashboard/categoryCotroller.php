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

        return view('dashboard.category', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return redirect()->route('dashboard.category')->with('error', 'Category not found.');
        }

        return view('dashboard.category', compact('category'));
    }

    public function addCategory()
    {
        return view('dashboard.addcategory');
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name' => $validatedData['name'],
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

        return view('dashboard.editcategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (! $category) {
            return redirect()->route('dashboard.category')->with('error', 'Category not found.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $validatedData['name'],
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
