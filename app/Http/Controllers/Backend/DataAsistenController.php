<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;

class DataAsistenController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['dataUser'] = User::get();
        return view('backend.dataAsisten.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.dataAsisten.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Hashing password
        $hashed = Hash::make($request->password);
        $password2 = $request->password2;

        // Checking if password and password2 are same
        if(Hash::check($password2, $hashed)){
            // If same, then create new user
            if($request->photo){
                $photo = $request->photo;
                $str = Str::random(8);
                $getExt = $photo->getClientOriginalExtension();
                $nameFile = $str.'.'.$getExt;
                // $nameFile = $photo->getClientOriginalName();
                $photo->move('avatar_asisten', $nameFile);
            }

            $store = User::create(array_merge($request->all(), [
                'password' => $hashed,
                'photo' => $nameFile,
            ]));
            if(!$store)
                return redirect()->route('createDataAss')->with('error', 'Data Added Failed');
            else
                return redirect()->route('indexDataAss')->with('success', 'Data Added Successfully');
        } else{
            return redirect()->route('createDataAss')->with('error', 'Data yang Dimasukkan Tidak Sama');
        }
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
        $data['edit'] = User::find($id);
        if(!$data['edit'])
            return redirect()->route('indexDataAss')->with('error', 'Data Not Found');
        
        return view('backend.dataAsisten.edit', $data);
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
        $update = User::find($id);
        if(!$update)
            return redirect()->back()->with('error', 'Data Not Found');

        // Hashing password
        if($request->password){
            $hashed = Hash::make($request->password);
            if(Hash::check($request->password2, $hashed)){
                $newPassword = $hashed;
            } else{
                return redirect()->back()->with('error', 'Password Not Match');
            }
        } else{
            $newPassword = $update->password;
        }

        // Checking if photo is changed
        if($request->hasFile('photo')){
            $path = 'avatar_asisten/'.$update->photo;
            if(File::exists($path)){
                File::delete($path);
            }

            $photo = $request->photo;
            $str = Str::random(8);
            $getExt = $photo->getClientOriginalExtension();
            $nameFile = $str.'.'.$getExt;
            $photo->move('avatar_asisten', $nameFile);
        } else{
            $nameFile = $update->photo;
        }
        $dataInput = array_merge($request->except('_token', 'password'), [
            'password' => $newPassword,
            'photo' => $nameFile,
        ]);
        $inputUpdate = User::updateOrCreate(['id' => $id], $dataInput);
        // dd($inputUpdate);
        if(!$inputUpdate)
            return redirect()->back()->with('error', 'Data Updated Failed');
        else
            return redirect()->route('indexDataAss')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = User::find($id);
        if(!$destroy)
            return redirect()->back()->with('error', 'Data Not Found');

        if($destroy->photo){
            $path = 'avatar_asisten/'.$destroy->photo;
            if(File::exists($path)){
                File::delete($path);
            }
        }

        $destroy->delete();
        if(!$destroy)
            return redirect()->back()->with('error', 'Data Cannot Be Deleted');
        else
            return redirect()->route('indexDataAss')->with('success', 'Data Has Been Deleted');
    }
}
