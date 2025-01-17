<?php

namespace App\Http\Controllers;

use App\Models\division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $division = division::all();
        return view('division.index', compact('division'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('division.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:divisions|max:100',
        ]);

        division::create($validated);

        return redirect()->route('division.index')->with('success', 'Division added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $division = division::findOrfail($id);
        return view('division.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $division = division::findOrfail($id);

        $validated = $request->validate([
            'name' => 'required|unique:divisions,name,'.$id.'|max:100',
        ]);

        $division->update($validated);

        return redirect()->route('division.index')->with('success', 'Division updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $division = division::findOrfail($id);
        $division->delete();

        return redirect()->route('division.index')->with('success', 'Division deleted successfully!');
    }
}
