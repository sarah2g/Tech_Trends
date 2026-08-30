<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class categoryCotroller extends Controller
{
    public function index()
    {
        $categories = Category::all()->paginate(10);
        return view('dashboard.category', compact('categories'));
    }
    public function show($id)
    {
        // Logic to retrieve category data based on the provided ID
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('dashboard.category')->with('error', 'Category not found.');
        }

        return view('dashboard.category', compact('category'));
    }
    public function create()
    {
        return view('dashboard.addcategory');
    }
    public function store(Request $request)
    {
        // Logic to add a new category based on the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        $category = Category::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
        ]);

        return redirect()->route('dashboard.category')->with('success', 'Category added successfully.');
    }
    
    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('dashboard.category')->with('error', 'Category not found.');
        }

        return view('dashboard.editcategory', compact('category'));
    }
    public function update(Request $request, $id){

        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('dashboard.category')->with('error', 'Category not found.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
        ]);

        return redirect()->route('dashboard.category')->with('success', 'Category updated successfully.');
    }
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('dashboard.category')->with('error', 'Category not found.');
        }

        $category->delete();

        return redirect()->route('dashboard.category')->with('success', 'Category deleted successfully.');
    }
    

}
