<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::all();
        return view('owner.index', compact('owners'));
    }

    public function create()
    {
        return view('owner.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:25',
            'password' => 'required|string|max:25',
        ]);

        Owner::create($validated);
        return redirect()->route('owner.index')->with('success', 'Owner created successfully');
    }

    public function edit($id)
    {
        $owner = Owner::findOrFail($id);
        return view('owner.edit', compact('owner'));
    }

    public function update(Request $request, $id)
    {
        $owner = Owner::findOrFail($id);
        
        $validated = $request->validate([
            'username' => 'required|string|max:25',
            'password' => 'nullable|string|max:25',
        ]);

        $owner->update($validated);
        return redirect()->route('owner.index')->with('success', 'Owner updated successfully');
    }

    public function destroy($id)
    {
        $owner = Owner::findOrFail($id);
        $owner->delete();
        return redirect()->route('owner.index')->with('success', 'Owner deleted successfully');
    }
}
