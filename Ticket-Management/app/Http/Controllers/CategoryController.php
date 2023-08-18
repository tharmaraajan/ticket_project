<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        if (auth()->user()->roles == 'Administrator')
        {
            return view('category.index');
        }
    }

    public function create()
    {
        if (auth()->user()->roles == 'Administrator')
        {
            return view('category.create');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|min:3|max:255',
        ]);

        Categories::create(['categories_name' => $request->category]);  //insert into `categories` (`categories_name`, `updated_at`, `created_at`) values (?, ?, ?)

        return back()->with('success', 'Successfully category created...!!');
    }

    public function edit(Categories $category)
    {
        if (auth()->user()->roles == 'Administrator')
        {
            return view('category.edit', compact('category'));
        }
    }

    public function update(Request $request, Categories $category)
    {
        $request->validate([
            'category' => 'required|min:3|max:255'
        ]);

        $category->update([
            'categories_name' => $request->category,
        ]); //update `categories` set `categories_name` = ?, `categories`.`updated_at` = ? where `id` = ?

        return to_route('category.index')->with('success', 'Category updated...!!');
    }

    public function destroy(Categories $category)
    {
        $category->delete();    //delete from `categories` where `id` = ?

        return to_route('category.index')->with('success', 'Category deleted...!!');
    }
}
