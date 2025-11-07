<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('name')->get();
        return view('usermanagement.dataroles', compact('roles'));
    }

    public function saveRecordRole(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:100|unique:roles,name',
            'department' => 'nullable|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $validated['name']]);

            if (!empty($validated['department'])) {
                $role->department = $validated['department'];
                $role->save();
            }

            DB::commit();
            sweetalert()->success('Role ditambahkan :)');
            return redirect()->route('role/list/page');

        } catch (\Throwable $e) {
            DB::rollBack();
            sweetalert()->error('Tambah Role gagal :(');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'SuperAdmin') {
            return back()->with('err', 'Role ini tidak boleh dihapus.');
        }
        $role->delete();
        return back()->with('ok', 'Role dihapus.');
    }
}
