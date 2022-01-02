<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use Illuminate\Http\Request;

class AddBoxController extends Controller
{
    public function index(Request $request)
    {

        $kategoriName = \App\Models\Category::where('id', $request->category_id)->first();
        $namaBarang = Storage::where('id', $request->name)->first();

        $view = view(
            'pages.boxes.kolomKanan',
            [
                "barangId" => $namaBarang->id,
                "name" => $namaBarang->name,
                "category_id" => $request->category_id,
                "kategoriName" => $kategoriName->name,
                "price" => $request->price,
                "value" => $request->value,
            ]
        )->render();
        echo $view;
    }

    public function addItems(Request $request)
    {

        $kategoriName = \App\Models\Category::where('id', $request->category_id)->first();

        $view = view(
            'pages.storages.kolomKanan',
            [
                "name" => $request->name,
                "category_id" => $request->category_id,
                "kategoriName" => $kategoriName->name,
                "price" => $request->price,
                "value" => $request->value,
            ]
        )->render();
        echo $view;
    }

    public function getItems(Request $request)
    {
        $data = Storage::where('id', $request->id)->first();
        $dataItems = [
            "kategori" => $data->category->name,
            "kategoriId" => $data->category_id,
            "harga" => $data->price,
            "jumlah" => $data->value,
        ];
        return $dataItems;
    }
}
