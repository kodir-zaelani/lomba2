<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */

    public static function middleware(): array
    {
        return [
            'permission:roles.index|roles.create|roles.edit|roles.delete|roles.trash',
        ];
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('backend.role.index', [
            'title' => 'Roles'
        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('backend.role.create', [
            'permissions' => Permission::orderBy('name', 'asc')->get(),
            'title' => 'Role Create'
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(RoleStoreRequest $request)
    {

        // $validated = $request->validate([
        //     'name' => 'required|min:3|unique:roles'
        // ]);

        // Default data
        $data = [
            'name'        => Str::lower($request->input('name')),
            'description' => $request->input('description')
        ];

        $role = Role::create($data);

        //assign permission to role
        $role->syncPermissions($request->input('permissions'));

        if ($role) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.roles.index')->with(['success' => 'Role ' . $role['name'] . ' Berhasil Ditambahkan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.roles.index')->with(['error' => 'Role Gagal Diupdate!']);
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($roleID)
    {
        $permissions = Permission::orderBy('name', 'asc')->get();
        $role = Role::findOrFail($roleID);
        // dd($role);

        return view('backend.role.edit',[
            'role' => $role,
            'permissions' => $permissions,
            'title' => 'Role Edit'
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(RoleUpdateRequest $request, $roleID)
    {
        // $this->validate($request, [
        //     'name' => 'required|min:3|unique:roles,name,' . $roleID
        // ]);

        $role = Role::findOrFail($roleID);

        $role->update([
            'name' => Str::lower($request->input('name')),
            'description' => $request->input('description')
        ]);

        //assign permission to role
        $role->syncPermissions($request->input('permissions'));

        if ($role) {
            //redirect dengan pesan sukses
            return redirect()->route('backend.roles.index')->with(['success' => 'Role ' . $role['name'] . ' Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('backend.roles.index')->with(['error' => 'Role Gagal Diupdate!']);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
}