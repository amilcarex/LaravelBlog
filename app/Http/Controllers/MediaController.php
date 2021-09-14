<?php

namespace App\Http\Controllers;

use App\Traits\GetImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //strpos($variable, 'string')

        $imagen = DB::table('uploads')->select('name','type','url')->where('id', '=', 1)->first();
        $storage = 'uploads';
        $file = Storage::disk($storage)->get($imagen->name);
        return response()->json($file, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if($request->hasFile('image')){
            $image = $request->image;
            $image_path = time() . '.' . $image->getClientOriginalName();
            $ext = pathinfo($image_path, PATHINFO_EXTENSION);
            $types = ['png', 'jpg', 'jpeg', 'svg', 'gif'];
            if(in_array($ext, $types)){
                Storage::disk('uploads')->put('photos/' . $image_path, File::get($image));
            }else{
                Storage::disk('uploads')->put('files/' . $image_path, File::get($image));
            }
            
            return response()->json(['location' => $image_path]);
        }
    }


    public function get(Request $request){

        $storage = 'uploads';
        $ext = pathinfo($request->image, PATHINFO_EXTENSION);
        $types = ['png', 'jpg', 'jpeg', 'svg', 'gif'];
        if(in_array($ext, $types)){
            $image = GetImage::boot('photos/' . $request->image, $storage);
        }else{
            $image = GetImage::boot('files/' . $request->image, $storage);
        }
        return $image;
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function images(Request $request)
    {
        //


        $url = env('APP_URL');
        return view('media.images', ['url' => $url]);

    }
    public function files(Request $request)
    {
        //
        $url = env('APP_URL');
        return view('media.files', ['url' => $url]);

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
        //
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
        //
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
