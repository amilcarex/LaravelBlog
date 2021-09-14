<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */

    public $per_page =  10;
    public function index(Request $request, User $model)
    {
        $search = $request->search ?: '';

        if ($search != '') {
            $users = User::Select('id', 'name', 'email', 'created_at', 'admin')->where('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->paginate($this->per_page);
        } else {
            $users = User::Select('id', 'name', 'email', 'created_at', 'admin')->paginate($this->per_page);
        }



        foreach ($users as $user) {
            $role = $user->roles()->first();
            $user->role = $role;
        }

        return view('users.index', ['users' => $users]);
    }

    public function create(Request $request)
    {

        $roles = Role::select('id', 'name')->get();

        return view('users.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'role' => 'required',
                'name' => 'required|string|max:80',
                'email' => 'required|string|email|max:80|unique:users',
                'hierarchy' => 'string|nullable',
                'description' => 'string|nullable',
                'skills' => 'string|nullable',
                'password' =>
                'required|string|min:8|regex:/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/|max:16|confirmed'
            ]
        );

        $role = $request->role;

        if ($request->image == null) {
            $image_name = env('APP_URL') . '/storage/placeholders/default-avatar.png';
        }else{
            $image_name = $request->image;
        }
        

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'hierarchy' => $request->hierarchy,
            'description' => $request->description,
            'skills' => $request->skills,
            'image' => $image_name,
            'password' => Hash::make($request->password),
        ])->roles()->attach(Role::where('id', $role)->first());

        return redirect()->route('user.index')->with(['success' => 'created']);
        
    }

    public function edit($id){

        $user = User::find($id);

        $roles = Role::select('id', 'name')->get();

        $user->role = $user->roles()->first();

        return view('users.edit', ['roles' => $roles, 'user' => $user ]);
    }
    public function updateProfileImage(Request $request){

        $user = User::find(auth()->user()->id);
        $user->image = $request->image;
        $user->update();
        return redirect()->route('profile.edit')->with(['success' => 'edited']);
    }

    public function update(Request $request){

        $this->validate(
            $request,
            [
                'role' => 'required',
                'name' => 'required|string|max:80',
                'email' => 'required|string|email|max:80|unique:users,email,' . $request->user_id,
                'hierarchy' => 'string|nullable',
                'description' => 'string|nullable',
                'skills' => 'string|nullable',
                'password' =>
                'required|string|min:8|regex:/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/|max:16',
                'new_password' =>
                'required|string|min:8|regex:/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/|max:16'
            ]
        );


        $user = User::find($request->user_id);
        if (!Hash::check( $request->password , $user->password)) {
            return redirect()->route('edit.user', ['id' => $user->id])->with(['error' => 'current_password_error']);
        }
        $authUser = User::find(auth()->user()->id);
        $user_role = $authUser->roles()->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->hierarchy = $request->hierarchy;
        $user->description = $request->description;
        $user->skills = $request->skills;
        $user->image = $request->image;
        $user->password = Hash::make($request->new_password);
        
        if ($user->admin == 1 && $request->role != 1) {
            return redirect()->route('edit.user', ['id' => $user->id])->with(['error' => 'main_account']);
        } else {
            if ($user_role->id != 1) {
                return redirect()->route('edit.user', ['id' => $user->id])->with(['error' => 'only_admin']);
            } else {
                $user->roles()->sync($request->role);
            }
        }
        if($user->update()){
            return redirect()->route('edit.user', ['id' => $user->id])->with(['success' => 'edited']);

        }else{
            return redirect()->route('edit.user', ['id' => $user->id])-with(['error' => 'error']);
        }
        

    }
    public function show(Request $request)
    {
        return response()->json($request);
    }

    public function destroy(Request $request)
    {

        $user = User::find($request->record_id);
        if($user->admin == 1){
            return redirect()->route('user.index')->with(['error' => 'main_account']);
        }else{
            if ($user->delete()) {
                return redirect()->route('user.index')->with(['success' => 'deleted']);
            } else {
                return redirect()->route('user.index')->with(['error' => 'error']);
            }
        }
    }
}
