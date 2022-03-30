<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;

class DataMateriController extends Controller
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
        $data['dataMateri'] = Materi::get();
        return view('backend.datamateri.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.dataMateri.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Materi::create($request->all()))
            return redirect()->route('indexDataMateri')->with('success', 'Data Added Successfully');
        else 
            return redirect()->route('indexDataMateri')->with('error', 'Data Added Failed');
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
        $edit = Materi::find($id);
        if(!$edit)
            return redirect()->route('indexDataMateri')->with('error', 'Data Not Found');
        return view('backend.dataMateri.edit', compact('edit'));
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
        $inputUpdate = Materi::updateOrCreate(['id' => $id], $request->all());
        if(!$inputUpdate)
            return redirect()->back()->with('error', 'Data Updated Failed');
        else
            return redirect()->route('indexDataMateri')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Materi::find($id);
        if(!$destroy)
            return redirect()->back()->with('error', 'Data Not Found');
        
            $destroy->delete();
        if(!$destroy)
            return redirect()->back()->with('error', 'Data Cannot Be Deleted');
        else
            return redirect()->route('indexDataMateri')->with('success', 'Data Has Been Deleted');
    }
}
