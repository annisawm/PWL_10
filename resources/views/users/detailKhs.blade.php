@extends('users.layout') 

@section('content') 
    <div class="row">
        <div class="col-lg-12 margin-tb"> 
            <div class="pull-left mt-2"> 
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2> 
            </div>
            <div class="text-center my-3">
                <h2>KARTU HASIL STUDI (KHS)</h2>    
            </div>
            <div>
                <h3><span class="text-bold">Nama :</span> {{$Mahasiswa->nama}}</h3>
                <h3><span class="text-bold">NIM :</span> {{$Mahasiswa->nim}}</h3>
                <h3><span class="text-bold">Kelas :</span> {{$Mahasiswa->kelas->nama_kelas}}</h3>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif 

    <table class="table table-bordered">
<tr>
    <th>Matakuliah</th>
    <th>SKS</th>
    <th>Semester</th>
    <th>Nilai</th>
</tr>

@foreach($Mahasiswa->matakuliah as $matkul)
<tr>
    <td>{{$matkul->nama_matkul}}</td>
    <td>{{$matkul->sks}}</td>
    <td>{{$matkul->semester}}</td>
    <td>{{$matkul->pivot->nilai}}</td>
</tr>
@endforeach
</table>
<div class="text-center">
    <a href="{{ route('mahasiswa.cetak_khs', $Mahasiswa->nim) }}" type="button" class="btn btn-danger mt-3">Cetak KHS</a>
</div>
@endsection