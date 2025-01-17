<?php

namespace App\Http\Controllers;

use App\Models\sizeUnit;
use Illuminate\Http\Request;

class SizeUnitController extends Controller
{
    public function index()
    {
        $sizeUnit = sizeUnit::all();
        return view('sizeUnit.index', compact('sizeUnit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sizeUnit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' =>'required|unique:size_units|max:10',
        ]);

        sizeUnit::create($validate);

        return redirect()->route('sizeunit.index')->with('success', 'Size added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(sizeUnit $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sizeUnit = sizeUnit::findOrfail($id);
        return view('sizeUnit.edit', compact('sizeUnit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sizeUnit = sizeUnit::findOrfail($id);

        $validated = $request->validate([
            'name' => 'required|unique:size_units,name,'.$id.'|max:10',
        ]);

        $sizeUnit->update($validated);

        return redirect()->route('sizeunit.index')->with('success', 'size updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sizeUnit = sizeUnit::findOrfail($id);
        $sizeUnit->delete();

        return redirect()->route('sizeunit.index')->with('success', 'size deleted successfully!');
    }
}
