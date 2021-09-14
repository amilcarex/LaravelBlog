<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $per_page = 10;

    public function index($id)
    {
        //
        if($id != auth()->user()->id){
            return  redirect()->route('user.index')->with(['error' => 'only_owner']);
        }

        $experiences = DB::table('user_experience')->where('user_id', $id)->paginate($this->per_page);

        return view('users.experiences.index', ['experiences' => $experiences]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($id)
    {

        if ($id != auth()->user()->id) {
            return  redirect()->route('user.index')->with(['error' => 'only_owner']);
        }

        return view('users.experiences.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'company' => 'string|nullable',
            'occupation' => 'string|required',
            'image' => 'string|nullable',
            'from' => 'required',
            'to' => 'nullable',
        ]);

        $company = $request->company != null ? $request->company : 'Independent';
        $image = $request->image != null ? $request->image : env('APP_URL') . '/storage/placeholders/no-logo.png';
        $experience = DB::table('user_experience')->insert([
            'company' => $company,
            'occupation' => $request->occupation,
            'from' => $request->from,
            'to' => $request->to,
            'logo' => $image,
            'user_id' => auth()->user()->id
        ]);
        $user_id = auth()->user()->id;

        return redirect()->route('user.experience', ['id' => $user_id])->with(['success' => 'created']);
    }

    public function edit($user, $id){


        $experience = DB::table('user_experience')->select('id', 'company', 'occupation', 'from','to', 'logo', 'user_id')->where('id', $id)->first();
        if($experience->user_id != $user){
            return  redirect()->route('user.index')->with(['error' => 'only_owner']);
        }

        return view('users.experiences.edit', ['experience' => $experience]);


    }


    public function update(Request $request){

        $this->validate($request, [
            'company' => 'string|nullable',
            'occupation' => 'string|required',
            'image' => 'string|nullable',
            'from' => 'required',
            'to' => 'nullable',
        ]);

        $experience = DB::table('user_experience')->select('user_id')->where('id', $request->id)->first();
        if($experience->user_id != auth()->user()->id){
            return  redirect()->route('user.index')->with(['error' => 'only_owner']);
        }

        $company = $request->company != null ? $request->company : 'Independent';
        $image = $request->image != null ? $request->image : env('APP_URL') . '/storage/placeholders/no-logo.png';

        DB::table('user_experience')->where('id', $request->id)->update([
            'company' => $company,
            'occupation' => $request->occupation,
            'from' => $request->from,
            'to' => $request->to,
            'logo' => $image,
        ]);
        return redirect()->route('edit.user.experience', ['user' => auth()->user()->id, 'id' => $request->id])->with(['success' => 'edited']);
    }

    public function destroy(Request $request)
    {

        $experience = DB::table('user_experience')->where('id', $request->record_id)->first();

        if ($experience->user_id != auth()->user()->id) {
            return redirect()->route('user.experience', ['id' => auth()->user()->id])->with(['error' => 'only_owner']);
        }else{
            if (DB::table('user_experience')->where('id', $request->record_id)->delete()) {
                return redirect()->route('user.experience', ['id' => auth()->user()->id, 'page' => $request->page])->with(['success' => 'deleted']);
            } else {
                return redirect()->route('user.experience', ['id' => auth()->user()->id, 'page' => $request->page])->with(['error' => 'error']);
            }
        }
         
        
    }
}
