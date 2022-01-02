<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Stok Gudang',
            'items' => Storage::all(),
        ];

        return view('pages.storages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session('role_id') == 2) {
            return redirect('/storages');
        }
        $data = [
            'title' => 'Tambah Barang',
            'categories' => Category::all(),
        ];

        return view('pages.storages.create', $data);
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
            return redirect('/storages');
        }
        $jumlahData = count($request->name);
        for ($i = 0; $i < $jumlahData; $i++) {
            $data = [
                "user_id" => session('id'),
                "name" => $request->name[$i],
                "category_id" => $request->category_id[$i],
                "price" => $request->price[$i],
                "value" => $request->value[$i],
            ];

            Storage::create($data);
        }

        Alert::success('Berhasil', 'Barang sudah ditambahkan.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function show(Storage $storage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function edit(Storage $storage)
    {
        if (session('role_id') == 2) {
            return redirect('/storages');
        }
        $data = [
            'title' => 'Edit Items',
            'item' => $storage,
            'categories' => Category::all(),
        ];

        return view('pages.storages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Storage $storage)
    {
        if (session('role_id') == 2) {
            return redirect('/storages');
        }
        $validatedData = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'value' => 'required',
        ]);
        $storage->update($validatedData);
        return redirect("/storages/$storage->id/edit")->with('success', 'Item Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Storage $storage)
    {
        if (session('role_id') == 2) {
            return redirect('/storages');
        }
        Storage::destroy('id', $storage->id);
        return redirect("/storages/" . $storage->box_id)->with('success', 'Barang Berhasil Dihapus');
    }
}
