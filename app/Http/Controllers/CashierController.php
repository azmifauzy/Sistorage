<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "title" => "Cashiers",
            "cashiers" => User::where('role_id', '2')->get()
        ];
        return view('pages.cashier.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $cashier)
    {
        $data = [
            "title" => "Cashiers",
            "kasir" => $cashier,
            "statuses" => Status::all(),
            "roles" => Role::all()
        ];
        return view('pages.cashier.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $cashier)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'status_id' => 'required',
            'role_id' => 'required',
        ]);

        $cashier->update($validatedData);
        return redirect("/cashiers/$cashier->id/edit")->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $cashier)
    {
        User::destroy('id', $cashier->id);
        return redirect("/cashiers")->with('success', 'Kasir Berhasil Dihapus');
    }
}
