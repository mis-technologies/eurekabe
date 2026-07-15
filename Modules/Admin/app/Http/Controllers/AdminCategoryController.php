<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Models\Category;
use Modules\Common\Models\Subject;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('subjects')->get();
        $subjects = Subject::with('category')->orderBy('name')->get();
        return view('admin::categories.index', compact('categories', 'subjects'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create(['name' => $request->name]);

        session()->flash('success', 'Category created successfully.');
        return redirect()->back();
    }

    public function destroyCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            session()->flash('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to delete category. It may have associated subjects.');
        }

        return redirect()->back();
    }

    public function storeSubject(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        Subject::create([
            'name'        => $request->name,
            'category_id' => $request->category_id,
        ]);

        session()->flash('success', 'Subject created successfully.');
        return redirect()->back();
    }

    public function destroySubject($id)
    {
        try {
            $subject = Subject::findOrFail($id);
            $subject->delete();

            session()->flash('success', 'Subject deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to delete subject. It may have associated exams.');
        }

        return redirect()->back();
    }
}
