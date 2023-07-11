<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;

class MasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masyarakats = Masyarakat::all();

    if ($masyarakats) {
        return ApiFormatter::createApi(200, 'Berhasil', $masyarakats);
    }else {
        return ApiFormatter::createApi(404, 'gagal');
    }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nik' => 'required|min:12',
                'nama' => 'required|min:3',
                'jenis_kelamin' => 'required',
                'tgl_lahir'=>'required',
                'gol_darah' => 'required',
                'alamat' => 'required|max:50',
            ]);

            $masyarakat = Masyarakat::create([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_lahir' => $request->tgl_lahir,
                'gol_darah' => $request->gol_darah,
                'alamat' => $request->alamat,
            ]);

            $getDataSaved = Masyarakat::where('id', $masyarakat->id)->first();

            if ($getDataSaved) {
                return ApiFormatter::createApi(200, 'success', $getDataSaved);
            }else {
                return ApiFormatter::createApi(404, 'failed');
            }

        } catch (Exception $error) {
            return ApiFormatter::createApi(404, 'failed', $error);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $masyarakatDetail = Masyarakat::where('id', $id)->first();

            if ($masyarakatDetail) {
                return ApiFormatter::createApi(200, 'success', $masyarakatDetail);
            }else {
                return ApiFormatter::createApi(404, 'failed');
            }

        } catch (Exception $error) {
            return ApiFormatter::createApi(404, 'failed', $error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Masyarakat $masyarakat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nik' => 'required|min:12',
                'nama' => 'required|min:3',
                'jenis_kelamin' => 'required',
                'tgl_lahir'=>'required',
                'gol_darah' => 'required',
                'alamat' => 'required|max:50',
            ]);

            $masyarakat = Masyarakat::findOrFail($id);

            $masyarakat->update([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_lahir' => $request->tgl_lahir,
                'gol_darah' => $request->gol_darah,
                'alamat' => $request->alamat,
            ]);

            $updatedMasyarakat = Masyarakat::where('id', $masyarakat->id)->first();

            if ($updatedMasyarakat) {
                return ApiFormatter::createApi(200, 'success', $updatedMasyarakat);
            }else {
                return ApiFormatter::createApi(404, 'failed');
            }

        } catch (Exception $error) {
            return ApiFormatter::createApi(404, 'failed', $error);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
           
            $masyarakat = Masyarakat::findOrFail($id);
            $proses = $masyarakat->delete();

            if ($proses) {
                return ApiFormatter::createApi(200, 'success');
            }else {
                return ApiFormatter::createApi(404, 'failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(404, 'failed', $error);
        }
    }

    public function createToken()
    {
        return csrf_token();
    }
}

