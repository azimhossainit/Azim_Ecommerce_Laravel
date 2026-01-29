<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Repositories\MediaRepository;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest('id')->get();
        $subCategories = SubCategory::latest('id')->get();
        return view('admin.subCategory.index', compact('subCategories', 'categories'));
    }
    public function store(SubCategoryRequest $request)
    {
        // Upload Image
        $media = null;
        if ($request->hasFile('image')) {
            $media = MediaRepository::storeByRequest($request->file('image'), 'subCategory', 'image');
        }
        // Create SubCategory
        SubCategory::create([
            'name'        => $request->name,
            'slug'        => $request->slug ?? Str::slug($request->name),
            'category_id' => $request->category,
            'media_id'   => null,
        ]);
        return to_route('subCategory.index')->withSuccess('SubCategory created successfully');
    }
        public function edit(SubCategory $subCategory){
        $categories = Category::latest('id')->get();
        return view('admin.subCategory.edit', compact('subCategory', 'categories'));
    }
     public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {
        $media = $subCategory->media;
        if($request->hasFile('image')){
            if($media && Storage::exists($media->src)){
                $media = MediaRepository::updateByRequest($request->file('image'), 'subCategory', 'image', $media);
            }else{
                $media = MediaRepository::storeByRequest($request->file('image'), 'subCategory', 'image');
            }

            // TEXT DATA update
    $subCategory->name        = $request->name;
    $subCategory->slug        = $request->slug ?? Str::slug($request->name);
    $subCategory->category_id = $request->category;

    $subCategory->save();  // ❗Important

    return redirect()->route('subCategory.index')->withSuccess('SubCategory updated successfully');
}
    }
}

