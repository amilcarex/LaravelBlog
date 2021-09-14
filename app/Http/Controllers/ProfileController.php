<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\Role;
use App\Models\User;
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

        $user = User::find(auth()->user()->id);

        $roles = Role::select('id', 'name')->get();

        $user->role = $user->roles()->first();

        return view('profile.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        $user = User::find(auth()->user()->id);
        $user_role = $user->roles()->first();
        if ($user->admin == 1 && $request->role != 1) {
            return redirect()->route('edit.user', ['id' => $user->id])->with(['error' => 'main_account']);
        } else {
            if ($user_role->id != 1) {
                return redirect()->route('edit.user', ['id' => $user->id])->with(['error' => 'only_admin']);
            } else {
                $user->roles()->sync($request->role);
            }
        }      
        $user->show = $request->show == true ? 1 : 0;
        $user->update($request->all());
        
        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('Password successfully updated.'));
    }
}
