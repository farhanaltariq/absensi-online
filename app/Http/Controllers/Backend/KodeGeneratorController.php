<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Code;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class KodeGeneratorController extends Controller
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
        $data['codes'] = Code::orderBy('created_at', 'DESC')
                        ->join('users', 'code.user_id', 'users.id')
                        ->where('code.user_id', Auth::id())
                        ->select('code.*', 'users.name')
                        ->get();
        return view('backend.generator.index', $data);
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
    public function store($param)
    {
        $kode = Str::random(7);

        $store = Code::create([
            'code' => $kode, 'user_id' => Auth::id(),
        ]);
        if(!$store)
            return redirect()->route('indexKode')->with('error', 'Failed Generating Code');

        if($param == 'frommodule')
            return redirect()->route('indexKode')->with('success', 'Code Generated Successfully = ' . $kode);
        else 
            return redirect()->route('home')->with('success', 'Code Generated Successfully = ' . $kode);
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
