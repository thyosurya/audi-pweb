<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:25',
            'password' => 'required|string|max:25',
        ]);

        Admin::create($validated);
        return redirect()->route('admin.index')->with('success', 'Admin created successfully');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        
        $validated = $request->validate([
            'username' => 'required|string|max:25',
            'password' => 'nullable|string|max:25',
        ]);

        $admin->update($validated);
        return redirect()->route('admin.index')->with('success', 'Admin updated successfully');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->route('admin.index')->with('success', 'Admin deleted successfully');
    }
}
