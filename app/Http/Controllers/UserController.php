<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Datatables;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => ['required', 'string', 'max:255'],
            'nik'   => ['required', 'string', 'max:16', 'unique:users'],
            'telp' =>   ['required', 'string', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $input = $request->all();
        $roleNames = explode("|", $request->role_name);
        $user = User::create([
            'nama' => ['required', 'string', 'max:255'],
            'nik'   => ['required', 'string', 'max:16', 'unique:users'],
            'telp' =>   ['required', 'string', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        $user->syncRoles($roleNames);

        return response()->json([
            'success'    => true,
            'message'    => 'User created.'
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
        $user = User::with(['roles.permissions', 'permissions'])->findOrFail($id);
        return $user;
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
        $roleNames = explode("|", $request->role_name);
        $this->validate($request, [
            'nama' => ['required', 'string', 'max:255'],
            'nik'   => ['required', 'string', 'max:16',],
            'telp' =>   ['required', 'string', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['string', 'min:8', 'confirmed'],
        ]);

        $user = User::findOrFail($id);

        $input = $request->all();
        $user->nama             = $input['nama'];
        $user->nik              = $input['nik'];
        $user->telp             = $input['telp'];
        $user->email            = $input['email'];
        if ($input['is_password_change'] == 'change') $user->password = Hash::make($input['password']);

        $user->syncRoles($roleNames);
        $user->save();

        return response()->json([
            'success'    => true,
            'message'    => 'User updated.'
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
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success'    => true,
            'message'    => 'User deleted.'
        ]);
    }

    public function dataTables()
    {
        $users = User::with(['roles'])->get();

        return Datatables::of($users)
            ->addColumn('role_name', function ($user) {
                if(count($user->roles)>0) return $user->roles[0]->name;
                return '-';
            })
            ->addColumn('action', function ($user) {
                $btn = '<a onclick="editUser(' . $user->id . ')" class="btn btn-info btn-small btn-circle text-white">Edit</a> ';
                if($user->id != Auth::user()->id){
                $btn .= '<a onclick="deleteUser(' . $user->id . ')" class="btn btn-danger btn-small btn-circle text-white">Delete</a>';
                }
                return $btn;
            })
            ->rawColumns(['role_name', 'action'])->make(true);
    }
}
