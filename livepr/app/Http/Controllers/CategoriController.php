<?php

namespace App\Http\Controllers;

use App\Categori;
use App\Commongenres;
use App\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class CategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Categori::orderBy('created_at','desc')->paginate(5);
        return view('categories.index',['channels' => $channels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $directories = Storage::disk('public_upload')->directories();
        $genres = Commongenres::where('state', 1)->get();
        return view('categories.create',['genres' => $genres, 'directories' => $directories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $channelfolder = '/upload/'.$request->input('channelfolder');
        if (!File::exists(public_path($channelfolder))) {
            return redirect('/categories/create')->with(array('status'=>'Channel do not exist! Try another.'));
        } else {    
            $img = $channelfolder."/index.jpg";
            $vid = $channelfolder."/index.m3u8";
            if(!File::exists(public_path($img)) || !File::exists(public_path($vid))) {
                return redirect('/categories/create')->with(array('status'=>'File do not exist! Try another.'));
            } else {
                $categories = $request->input();
                $categories['state'] = 1;
                $categories['stillImageName'] = $img;
                $catsuser = Categori::create($categories);
                var_dump($catsuser);
                $videos = array(
                    'categori_id' => $catsuser->id,
                    'streamUrl' => $vid,
                    'state' => 1
                );
                Video::create($videos);
                return redirect('/categories');
            }
        }
        // if ($request->file('stillImageName')->isValid()) {
        //     $extension = $request->stillImageName->extension();
        //     $path = $request->stillImageName->path();
        //     echo $path."//".$extension;
        //     $filename = date('Y-m-d-H-I-s');
        //     $path = $request->file('stillImageName')->move('images', $filename.".".$extension); //uploading
        // }
        // $data = $request->input();
        // $data['stillImageName'] = url('')."/".$path;
        // if(Categori::create($data)) {
        //     return redirect('/categories');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\categori  $categori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $channel = Categori::findOrFail($id);
        return view('categories.show',['channel' => $channel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\categori  $categori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genres = Commongenres::where('state', 1)->get();
        $channel = Categori::findOrFail($id);
        return view('categories.edit',['channel' => $channel, 'commongenres' => $genres]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\categori  $categori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $filename = "";
        $path = "";
        $users = Categori::findOrFail($id);
        if($request->hasFile('stillImageName')){
            if ($request->file('stillImageName')->isValid()) {
                $extension = $request->stillImageName->extension();
                $filename = date('Y-m-d-H-I-s');
                $path = $request->file('stillImageName')->move('images', $filename.".".$extension); //uploading
                $users->stillImageName = url('')."/".$path;
            } else {
                return redirect('/categories');
            }
        }

        $users->channelName = $request->input('channelName');
        $users->hlsUrlPhoneAUTO = $request->input('hlsUrlPhoneAUTO');
        $users->under19Content = $request->input('under19Content');
        $users->genreCd = $request->input('genreCd');
        $users->state = $request->input('state');
        $users->save();
        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\categori  $categori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categori::findOrFail($id)->delete();
        return redirect('/categories');
    }

    public function tv_all()
    {
        // $data = Categori::all();
        $url = "http://192.168.110.61";
        $data = Categori::select('channelName', 'programs', 'hlsUrlPhoneAUTO', 'stillImageName', 'under19Content', 'id as serviceId', 'genreCd')->get();

        foreach ($data as $each) {
            $each['stillImageName'] = $url.$each['stillImageName'];
        }

        $can = Commongenres::select('id as cdNo', 'cdName')->get();
        $result["channels"] = $data;
        $result["commonGenre"] = $can;
        echo json_encode($result);
    }
}
