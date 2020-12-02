<?php

namespace App\Http\Controllers;

use App\Commongenres;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CommongenresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Commongenres::orderBy('created_at','desc')->paginate(5);
        return view('commongenres.index',['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('commongenres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Commongenres::create($request->input())) {
            return redirect('/commongenre');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Commongenres  $commongenres
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        $commongenres = Commongenres::findOrFail($id);
        return view('commongenres.show',['categori' => $commongenres]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Commongenres  $commongenres
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commongenres = Commongenres::findOrFail($id);
        return view('commongenres.edit',['categori' => $commongenres]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commongenres  $commongenres
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $users = Commongenres::findOrFail($id);
        $users->cdName = $request->input('cdName');
        $users->state = $request->input('state');
        $users->save();
        return redirect('/commongenre');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Commongenres  $commongenres
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Commongenres::findOrFail($id)->delete();
        return redirect('/commongenre');
    }
}
