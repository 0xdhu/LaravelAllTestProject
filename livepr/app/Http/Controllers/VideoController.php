<?php

namespace App\Http\Controllers;

use App\Video;
use App\Categori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = DB::table('categories')->where('categories.state', '=', 1)
        ->leftjoin('videos', function ($join) {
            $join->on('categories.id', '=', 'videos.categori_id');
        })->select('categories.channelName', 'categories.genreCd', 'categories.id','videos.id as vid', 'categories.stillImageName', 'videos.state', 'videos.streamUrl', 'videos.categori_id', 'videos.updated_at')->paginate(5);
        //var_dump($videos);
        return view('video.index',['videos' => $videos]);
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
        $filename = "";
        $path = "";

        $data = $request->input();

        if($request->hasFile('streamUrl')){
            if ($request->file('streamUrl')->isValid()) {
                $extension = $request->streamUrl->extension();
                $filename = date('Y-m-d-H-I-s');
                $path = $request->file('streamUrl')->move('streamvideo', $filename.".".$extension); //uploading

                $data['streamUrl'] = url('')."/".$path;
                $data['state'] = 1;

            } else {
                return redirect('/videos');
            }
        }

        if(Video::create($data)) {
            return redirect('/videos');
        }
        return redirect('/videos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $videos =  Categori::findOrFail($id);
        return view('video.edit',['videos' => $videos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video::findOrFail($id)->delete();
        return redirect('/commongenre');
    }

    public function tv_all($id) {
        $url = "http://192.168.110.61";
        $rlt = Video::where('categori_id', $id)->select('streamUrl')->get();
        foreach ($rlt as $each) {
            $each['streamUrl'] = $url.$each['streamUrl'];
        }
        echo json_encode($rlt);
        return;
    }
}
