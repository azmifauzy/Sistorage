<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Item;
use App\Models\Category;
use App\Models\StatusBox;
use App\Models\Storage;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Boxes',
            'boxes' => Box::All(),
            'statusBox' => StatusBox::all(),
        ];

        return view('pages.boxes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Boxes',
            'categories' => Category::all(),
            'items' => Storage::all(),
        ];

        return view('pages.boxes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // INSERT DATA BOX
        $idBox = IdGenerator::generate(['table' => 'boxes', 'length' => 12, 'prefix' => "BOX-"]);


        // INSERT DATA BARANG
        $totalHarga = 0;
        $jumlahDataBarang = count($request->name);
        for ($i = 0; $i < $jumlahDataBarang; $i++) {

            $dataItems = [
                'user_id' => session('id'),
                'category_id' => $request->category_id[$i],
                'box_id' => $idBox,
                'name' => $request->name[$i],
                'price' => $request->price[$i],
                'value' => $request->value[$i],
            ];

            // MENGHITUNG SUBTOTAL
            for ($x = 0; $x < $request->value[$i]; $x++) {
                $totalHarga += $request->price[$i];
            }

            // GET DATA BARANG THEN UPDATE UNIT
            $dataBarang = Storage::where('id', $request->barangId[$i])->first();
            Storage::where('id', $request->barangId[$i])->update(['value' => $dataBarang->value - $request->value[$i]]);

            Item::create($dataItems);
        }

        $dataBoxes = [
            "id" => $idBox,
            "statusBox_id" => 1,
            "sender" => $request->sender,
            "receiver" => $request->receiver,
            "address" => $request->address,
            "telepon" => $request->telepon,
            "subtotal" => $totalHarga,
        ];
        Box::create($dataBoxes);
        return redirect('/boxes')->with('success', 'Data Box telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function show(Box $box)
    {

        $totalHarga = 0;

        foreach ($box->item as $item) {
            for ($x = 0; $x < $item->value; $x++) {
                $totalHarga += $item->price;
            }
        }

        $data = [
            'title' => 'Boxes',
            'boxes' => $box,
            'totalHarga' => $totalHarga,
            'categories' => Category::all(),
            'statusBox' => StatusBox::all(),
            'items' => Storage::all(),
        ];

        return view('pages.boxes.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function edit(Box $box)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Box $box)
    {

        $time = Carbon::now();

        $validatedData = $request->validate([
            'statusBox_id' => 'required',
            'sender' => 'required',
            'receiver' => 'required',
            'address' => 'required',
            'telepon' => 'required',
        ]);
        if ($request->statusBox_id == 2) {
            $validatedData["date_sent"] = $time->format('d');
            $getReport = Report::where(["tahun" => $time->year, "bulan" => $time->format('F')])->first();
            if (!$getReport) {
                // Buat Data Report
                $dataReport = [
                    "tahun" => $time->year,
                    "bulan" => $time->format('F'),
                ];
                Report::create($dataReport);
                $getNewReport = Report::where(["tahun" => $time->year, "bulan" => $time->format('F')])->first();
                // Ubah Report ID from nullable to ID
                $validatedData["report_id"] = $getNewReport->id;
            } else {
                $validatedData["report_id"] = $getReport->id;
            }
        }
        $box->update($validatedData);


        return redirect("/boxes/$box->id")->with('success', 'Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function destroy(Box $box)
    {
        Box::destroy('id', $box->id);
        $data = Item::where('box_id', $box->id)->get();
        foreach ($data as $item) {
            Item::destroy('id', $item->id);
        }

        return redirect("/boxes")->with('success', 'Data Box dan Barang Berhasil Dihapus');
    }
}
