<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SettingsController extends Controller
{
    //
    public function indexGeneral(){

        $settings = DB::table('general_settings')->first();
        $roles = [];
        $role = ['id' => 1, 'type' => 'Admin'];
        array_push($roles, $role );
        $role = ['id' => 2, 'type' => 'User'];
        array_push($roles, $role);
        return view('settings.general.index', ['settings' => $settings, 'roles' => $roles]);
    }

    public function indexSocial(){

        $settings = DB::table('social_settings')->select('facebook', 'twitter', 'linkedIn', 'youtube', 'instagram', 'github', 'twitch',)->where('id', 1)->first();

        return view('settings.social.index', ['settings' => $settings]);
    }

    public function updateGeneral(Request $request){

        $settings = DB::table('general_settings')->where('id', 1)->first();
        
        if (strstr($request->homeVideo, "youtube.com")) {
            if (!strstr($request->homeVideo, "/embed/")) {
                $get_video = explode("/", $request->homeVideo);
                $video = explode("=", end($get_video));
                $video = "https://www.youtube.com/embed/" . end($video);
                $homeVideo = $video;
                $local = false;
            }
        }else{
            $local = true;
            $homeVideo = $request->homeVideo;
        }

        DB::table('general_settings')->where('id', 1)->update([
            'webTittle' => $request->webTittle,
            'homeVideo' => $homeVideo,
            'localVideo' => $local == true ? 1 : 0,
            'allowRegister' => $request->allowRegister == true ? 1 : 0,
            'pinnedOrder' => $request->pinnedOrder == 1 ? 'Desc' : 'Asc',
            'defaultRole' => intval($request->defaultRole),

        ]);

        return redirect()->route('index.general.settings')->with(['success' => 'edited']);

    }

    public function updateSocial(Request $request){


        DB::table('social_settings')->where('id', 1)->update([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'linkedIn' => $request->linkedIn,
            'youtube' => $request->youtube,
            'github' => $request->github,
            'twitch' => $request->twitch,
        ]);


        return redirect()->route('index.social.settings')->with(['success' => 'edited']);

    }

  
}
