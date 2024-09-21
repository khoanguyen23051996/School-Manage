<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user['getRecord'] = User::getRecord();

        return view('admin.pages.admin.index', $user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.pages.admin.create');     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users'
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->role = 1;
        $user->save();

        return redirect()->route('admin.admin')->with('success', 'Created Admin Successfully!');
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
        $user['getRecord'] = User::find($id);

        if(!empty($user['getRecord'])){
            return view('admin.pages.admin.edit', $user);
        }
        else{
            abort(404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::find($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admin.admin')->with('success', 'Update Admin Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        
        $user->soft_delete = 1;
        $user->save();

        return redirect()->route('admin.admin')->with('success', 'Deleted Admin Successfully!');
    }
}
