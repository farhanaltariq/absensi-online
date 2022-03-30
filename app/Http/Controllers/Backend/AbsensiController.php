<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Code;
use App\Models\Absensi;
use App\Models\Materi;
use App\Models\Kelas;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function store(Request $request){
        $idLogin = Auth::id();
        $getIdAsisten = $request->id_asisten;
        $getCode = $request->kode;
        $getIdKelas = $request->kelas;
        $getIdMateri = $request->materi;
        $getPeran = $request->peran_jaga;

        // check id asisten
        $getMatchid = User::where('id', $getIdAsisten)->first();
        if($idLogin == $getMatchid->id){
            // check code
            $getMatchKode = Code::where('code', $getCode)->first();
            if($getCode = $getMatchKode->code && (empty($getMatchKode->user_id_get)) ){
                // check kondisi kode absen tidak sama dengan yang dibuat dengan diri sendiri
                $today = Carbon::now('GMT+7')->toDateString();
                $timeNow = Carbon::now('GMT+7')->toTimeString();

                if($getMatchKode->user_id != $idLogin){
                    $store = Absensi::create([
                        'kelas_id' => $getIdKelas,
                        'materi_id' => $getIdMateri,
                        'asisten_id' => $idLogin,
                        'teaching_role' => $getPeran,
                        'start' => $timeNow,
                        'code_id' => $getMatchKode->id,
                        'date' => now(),
                    ]);

                    if(!$store){
                        return redirect()->route('home')->with('error', 'Failed Absensi');
                    } else{
                        return redirect()->route('home')->with('success', 'Absen Berhasil');
                    }
                } else{
                    return redirect()->route('home')->with('error', 'Kode absen tidak boleh menggunakan kode diri sendiri');
                }
            } 
        } 
    }

    public function update(){
        $carbon = Carbon::now('GMT+7');
        $today = $carbon->toDateString();
        $idLogin = Auth::id();
        $cekAbsen = Absensi::where('asisten_id', Auth::id())->where('date', $today)->where('end', null)->first();

        $start = $cekAbsen->start;
        $out = $carbon->toTimeString();
        $duration = $carbon->diffInMinutes($start);
        $cekAbsen->end = $out;
        $cekAbsen->duration = $duration;
        $cekAbsen->save();
        if(!$cekAbsen){
            return redirect()->route('home')->with('error', 'Clock Out Error');
        } else{
            return redirect()->route('home')->with('success', 'Clock Out Berhasil');
        }
    }
}
