<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'caption' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg'
        ]);
        // image
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if (isset($image)) {
            //            membuat uniq name image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //            cek dir yang sudah ada
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }
            //            upload gambar
            $category = Image::make($image)->save();
            Storage::disk('public')->put('category/' . $imagename, $category);
            //            cek category slider yang sudah ada
            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }
            //            slider upload
            $slider = Image::make($image)->save();
            Storage::disk('public')->put('category/slider/' . $imagename, $slider);
        } else {
            $imagename = "default.png";
        }
        $category = new Category();
        $category->name = $request->name;
        $category->caption = $request->caption;
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();
        Toastr::success('Data berhasil ditambahkan', 'Berhasil');
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'caption' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg'
        ]);
        // image
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $category = Category::find($id);
        if (isset($image)) {
            //            membuat uniq name image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //            cek dir yang sudah ada
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }
            //            hapus gambar lama
            if (Storage::disk('public')->exists('category/' . $category->image)) {
                Storage::disk('public')->delete('category/' . $category->image);
            }
            //              resize
            $categoryImage = Image::make($image)->save();
            Storage::disk('public')->put('category/' . $imagename, $categoryImage);
            //            cek category slider yang sudah ada
            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }
            //            hapus slider gambar lama
            if (Storage::disk('public')->exists('category/slider/' . $category->image)) {
                Storage::disk('public')->delete('category/slider/' . $category->image);
            }
            //            slider upload
            $slider = Image::make($image)->save();
            Storage::disk('public')->put('category/slider/' . $imagename, $slider);
        } else {
            $imagename = $category->image;
        }

        $category->name = $request->name;
        $category->caption = $request->caption;
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();
        Toastr::success('Data berhasil ditambahkan', 'Berhasil');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (Storage::disk('public')->exists('category/' . $category->image)) {
            Storage::disk('public')->delete('category/' . $category->image);
        }

        if (Storage::disk('public')->exists('category/slider/' . $category->image)) {
            Storage::disk('public')->delete('category/slider/' . $category->image);
        }
        $category->delete();
        Toastr::success('Data berhasil dihapus', 'Berhasil');
        return redirect()->route('admin.category.index');
    }
}
