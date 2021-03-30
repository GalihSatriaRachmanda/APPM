<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($request->id);

        $input = $request->all();
        $user->nama             = $input['nama'];
        $user->nik              = $input['nik'];
        $user->telp             = $input['telp'];
        $user->email            = $input['email'];

        $user->save();

        return response()->json([
            'success'    => true,
            'message'    => 'User updated.'
        ]);
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(Request $request, $id)
    {
        $user = User::findOrFail($request->id);

        $input = $request->all();
        $user->password = Hash::make($input['password']);

        $user->save();
        
        return response()->json([
            'success'    => true,
            'message'    => 'Password updated.'
        ]);
    }
}
