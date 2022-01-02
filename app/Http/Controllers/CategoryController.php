<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Categories',
            'categories' => Category::All(),
        ];

        return view('pages.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session('role_id') == 2) {
            return redirect('/categories');
        }
        $data = [
            'title' => 'Categories',
            'categories' => Category::all(),
        ];

        return view('pages.categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (session('role_id') == 2) {
            return redirect('/categories');
        }
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        Category::create($validatedData);
        return redirect('/categories')->with('success', 'Berhasil Menambah Kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if (session('role_id') == 2) {
            return redirect('/categories');
        }
        $data = [
            'title' => 'Detail',
            'category' => $category,
        ];

        return view('pages.categories.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (session('role_id') == 2) {
            return redirect('/categories');
        }
        $data = [
            'title' => 'Edit',
            'category' => $category,
        ];

        return view('pages.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if (session('role_id') == 2) {
            return redirect('/categories');
        }
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $category->update($validatedData);
        return redirect("/categories")->with('success', 'Kategori Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (session('role_id') == 2) {
            return redirect('/categories');
        }
        Category::destroy('id', $category->id);
        return redirect("/categories")->with('success', 'Kategori Berhasil Dihapus');
    }
}
