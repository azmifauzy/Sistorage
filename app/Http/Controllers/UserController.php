<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('role_id') == 2) {
            return redirect('/');
        }

        $data = [
            "title" => "Users",
            "users" => User::all()
        ];
        return view('pages.users.index', $data);
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
    public function edit(User $user)
    {
        if (session('role_id') == 2) {
            return redirect('/');
        }
        $data = [
            "title" => "Users",
            "user" => $user,
            "statuses" => Status::all(),
            "roles" => Role::all()
        ];
        return view('pages.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (session('role_id') == 2) {
            return redirect('/');
        }
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'status_id' => 'required',
            'role_id' => 'required',
        ]);

        $user->update($validatedData);
        return redirect("/users/$user->id/edit")->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy('id', $user->id);
        return redirect("/users")->with('success', 'Pengguna Berhasil Dihapus');
    }
}
