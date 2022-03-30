<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
class DataKelasController extends Controller
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
        $data = Kelas::all();
        return view('backend.datakelas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.dataKelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Kelas::create($request->all()))
            return redirect()->route('indexDataKelas')->with('success', 'Data Added Successfully');
        else 
            return redirect()->route('indexDataKelas')->with('error', 'Data Added Failed');
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
        $data['edit'] = Kelas::find($id);
        if(!$data['edit'])
            return redirect()->route('indexDataKelas')->with('error', 'Data Not Found');
        
        return view('backend.dataKelas.edit', $data);
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
        // dd($request->all());
        $inputUpdate = Kelas::updateOrCreate(['id' => $id], $request->all());
        if(!$inputUpdate)
            return redirect()->back()->with('error', 'Data Updated Failed');
        else
            return redirect()->route('indexDataKelas')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Kelas::find($id);
        if(!$destroy)
            return redirect()->back()->with('error', 'Data Not Found');
        
            $destroy->delete();
        if(!$destroy)
            return redirect()->back()->with('error', 'Data Cannot Be Deleted');
        else
            return redirect()->route('indexDataKelas')->with('success', 'Data Has Been Deleted');
    }
}
