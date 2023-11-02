<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('id')->select(['id', 'title', 'slug', 'updated_at'])->paginate();
        // return $categories;
        return view('backend.layouts.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        Category::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
        ]);

        Toastr::success('Data Store Successfully');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $category = Category::where('slug', $id)->first();
        $category = Category::whereSlug($id)->first();
        // return $category;
        return view('backend.layouts.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        // dd($request->all());

        $category = Category::whereSlug($id)->first();

        $category->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'is_active' => $request->filled('is_active'),
        ]);

        Toastr::success('Data Updated Successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::whereSlug($id)->first()->delete();
        Toastr::success('Data Delete Successfully');
        return redirect()->route('category.index');
    }
}
