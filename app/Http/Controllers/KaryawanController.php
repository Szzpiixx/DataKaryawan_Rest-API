<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Http\Requests\KaryawanStoreRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = Karyawan::all();
        
        return response()->json([
            'karyawan' => $karyawan
        ], 200);
    }

    public function createToken()
    {
        return csrf_token();
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
    public function store(KaryawanStoreRequest $request)
    {
        try{
            $imageName = Str::random(32).".".$request->file('foto')->getClientOriginalExtension();

            Karyawan::create([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'umur' => $request->umur,
                'alamat' => $request->alamat,
                'notelp' => $request->notelp,
                'email' => $request->email,
                'foto' => $imageName,

            ]);

            Storage::disk('public')->put($imageName, file_get_contents($request->file('foto')));
            

            return response()->json([
                'message' => 'Data Karyawan successfully created.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went really wrong!'
            ], 500);
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
        $karyawan = Karyawan::find($id);
        if(!$karyawan){
            return response()->json([
                'message' => 'Karyawan not found.'
            ], 404);
        }

        return response()->json([
            'karyawan' => $karyawan
        ], 200);
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
    public function update(KaryawanStoreRequest $request, $id)
    {
        try {
            $karyawan = Karyawan::find($id);
            if(!$karyawan){
            return response()->json([
                'message' => 'Karyawan not found.'
            ], 404);
            }
            
           $karyawan->nik = $request->nik;
           $karyawan->nama = $request->nama;
           $karyawan->umur = $request->umur;
           $karyawan->alamat = $request->alamat;
           $karyawan->notelp = $request->notelp;
           $karyawan->email = $request->email;

            if($request->foto) {
                $storage = Storage::disk('public');

                if($storage->exists($karyawan->foto))
                    $storage->delete($karyawan->foto);

                $imageName = Str::random(32).".".$request->foto->getClientOriginalExtension();
                $karyawan->foto =$imageName;

                $storage->put($imageName, file_get_contents($request->foto));
            }

            $karyawan->save();

            return response()->json([
                'karyawan' => 'Karyawan successfully updated.'
            ], 200);

        } catch (\Exception $e){
            return response()->json([
                'message' => "Something went really wrong!"
            ],500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( string $id)
    {
        $karyawan = Karyawan::find($id);
        if(!$karyawan){
            return response()->json([
                'message' => 'Karyawan not found.'
            ],404);
        }

        $storage = Storage::disk('public');

        if($storage->exists($karyawan->foto))
            $storage->delete($karyawan->foto);

            $karyawan->delete();

            return response()->json([
                'message' => "Karyawan successfully Deleted"
            ],200);
    }
}