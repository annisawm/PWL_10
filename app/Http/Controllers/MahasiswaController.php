<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{

    public function index()
    {
        $Mahasiswa = Mahasiswa::with('kelas')->get();
        $paginate = Mahasiswa::orderBy('nim', 'asc')->paginate(3);
        return view('users.index', ['mahasiswa' => $Mahasiswa, 'paginate' => $paginate]);
    }

    public function create()
    {
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('users.create', ['kelas' => $kelas]);
    }



    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([ 
            'nim' => 'required', 
            'nama' => 'required', 
            'kelas_id' => 'required', 
            'jurusan' => 'required',
            'image' => 'required',
            ]);

            $image_name = "";
            if($request->file('image')) {
                $image_name = $request->file('image')->store('images', 'public');
            }
            
            $Mahasiswa = new Mahasiswa;
            $Mahasiswa->nim = $request->get('nim');
            $Mahasiswa->nama = $request->get('nama');
            $Mahasiswa->jurusan = $request->get('jurusan');
            
            $kelas = new Kelas;
            $kelas->id = $request->get('kelas_id');

            $Mahasiswa->kelas()->associate($kelas);
            $Mahasiswa->save();
            
            return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    
    public function show($nim)
    {
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        return view('users.detail', ['Mahasiswa' => $Mahasiswa]);
    }

    public function detailKhs($nim) {
        $Mahasiswa = Mahasiswa::with('kelas', 'matakuliah')->where('nim', $nim)->first();
        return view('users.detailKhs', compact('Mahasiswa'));
    }

    public function cetak_khs($nim) 
    {
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $pdf = PDF::loadview('users.cetakKhs', compact('Mahasiswa'));
        return $pdf->stream();
    }

    public function edit($nim)
    {
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $kelas = Kelas::all();
        return view('users.edit', compact('Mahasiswa', 'kelas'));
    }


    public function update(Request $request, $nim)
    {
        $request->validate([ 
            'nim' => 'required', 
            'nama' => 'required', 
            'kelas' => 'required', 
            'jurusan' => 'required',
            ]);

            $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
            if($Mahasiswa->foto && file_exists('app/public/' . $mahasiswa->foto)) {
                \Storage::delete('public/' . $mahasiswa->foto);
            }
            $Mahasiswa->nim = $request->get('nim');
            $Mahasiswa->nama = $request->get('nama');
            $Mahasiswa->jurusan = $request->get('jurusan');
            $image_name = $request->file('image')->store('images', 'public');
            $Mahasiswa->foto = $image_name;
            $Mahasiswa -> save();

            $kelas = new Kelas;
            $kelas->id =$request->get('kelas');

            $Mahasiswa->kelas()->associate($kelas);
            $Mahasiswa -> save();
            
            return redirect()->route('mahasiswa.index') 
                ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    
    public function destroy($nim)
    {
        Mahasiswa::find($nim)->delete(); 
        return redirect()->route('mahasiswa.index') 
            -> with('success', 'Mahasiswa Berhasil Dihapus');
    }
}