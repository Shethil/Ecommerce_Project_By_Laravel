<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
// use Intervention\Image\Facades\Image;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('id')->select(['id', 'category_image', 'title', 'slug', 'updated_at'])->paginate();
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
        // dd($request->all());
        $category = Category::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
        ]);

        $this->image_upload($request, $category->id);

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

        $this->image_upload($request, $category->id);

        Toastr::success('Data Updated Successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::whereSlug($id)->first();

        if ($category->category_image) {
            $photo_location = 'uploads/category/' . $category->category_image;
            unlink($photo_location);
        }

        $category->delete();

        Toastr::success('Data Delete Successfully');
        return redirect()->route('category.index');
    }

    public function image_upload($request, $item_id)
    {

        $category = Category::findorFail($item_id);

        if ($request->hasFile('category_image')) {

            if ($category->category_image != 'default-image.jpg') {
                $photo_location = 'public/uploads/category/';
                $old_photo_location = $photo_location .
                $category->category_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/category/';
            $uploaded_photo = $request->file('category_image');
            $new_photo_name = $category->id . '.' .
            $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(105, 105)->save(base_path($new_photo_location), 40);
            $check = $category->update([
                'category_image' => $new_photo_name,
            ]);
        }
    }
}
