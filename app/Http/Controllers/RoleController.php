<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return $roles;
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
        $this->validate($request, [
           'name'   => 'required|string|max:80|unique:roles',
        ]);

        $role = Role::create($request->all());
        if($request->permission_name){
            foreach ($request->permission_name as $key => $permission) {
                $role->givePermissionTo($permission);
            }
        }

        return response()->json([
           'success'    => true,
           'message'    => 'Role created'
        ]);
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
    public function edit($id)
    {
        $role = Role::with('permissions')->find($id);
        return $role;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => 'required|string|max:80|unique:roles,name,'.$id.',id',
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name'  => $request->name
        ]);
        $role->syncPermissions($request->permission_name);

        return response()->json([
            'success'    => true,
            'message'    => 'Role updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Role deleted.'
        ]);
    }
    
    public function dataTables(){
        $roles = Role::all();

        return DataTables::of($roles)
            ->addColumn('action', function($role){
                return '<a onclick="editRole('. $role->id .')" class="btn btn-info btn-small btn-circle text-white">Edit</a> ' .
                '<a onclick="deleteRole('. $role->id .')" class="btn btn-danger btn-small btn-circle text-white">Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }
}
