<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class['getRecord'] = ClassModel::getRecord();

        return view('admin.pages.class.index', $class);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $class = new ClassModel();
        $class->class_name = trim($request->class_name);
        $class->status = trim($request->status);
        $class->created_by = Auth::user()->id;
        $class->save();

        return redirect()->route('admin.class')->with('success', 'Created Class Successfully');
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
        $class['getRecord'] = ClassModel::find($id);

        if(!empty($class['getRecord'])){
            return view('admin.pages.class.edit', $class);
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
        $class = ClassModel::find($id);
        $class->class_name = trim($request->class_name);
        $class->status = trim($request->status);
        $class->save();

        return redirect()->route('admin.class')->with('success', 'Update Class Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = ClassModel::find($id);
        
        $class->soft_delete = 1;
        $class->save();

        return redirect()->route('admin.class')->with('success', 'Deleted Class Successfully!');
    }
}
