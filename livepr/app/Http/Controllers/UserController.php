<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Users::orderBy('created_at','desc')->paginate(5);
        return view('users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Users::create($request->input())) {
            return redirect('/users');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Users::findOrFail($id);
        return view('users.show',['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Users::findOrFail($id);
        return view('users.edit',['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $users = Users::findOrFail($id);
        $users->name = $request->input('name');
        $users->role = $request->input('role');
        $users->save();
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        Users::findOrFail($id)->delete();
        return redirect('/commongenre');
    }
    public function tv_login(Request $request){
        $email = $request->input('login');
        $password = $request->input('password');
        $user = Users::where('email','=',$email)->first();
        
        if(password_verify($password, $user->password) && $user->role == 1) {
        // if($email == 'news@gmail.com' && $password == 'news') {
            $date = date(" d M Y H:i:s",strtotime('1 January 2020')) . 'GMT';
            echo "CORN_AC=ASDKSJDFKSDJKNEWS; EXPIRES{$date} ; Domain=dSDFSDFSSSDFSDFSDFSDFS;";
        }
        return;
    }
}
