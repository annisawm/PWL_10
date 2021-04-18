@extends('users.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-3">
                <h5 class="text-center">JURUSAN TEKNOLOGI INFORMASI - POLITEKNIK NEGERI MALANG</h5>
            </div>
            <div class="text-center my-3">
                <h6>KARTU HASIL STUDI (KHS)</h6>    
            </div>
            <div>
                <h6><span class="text-bold">Nama: </span> {{$Mahasiswa->nama}}</h6>
                <h6><span class="text-bold">NIM: </span> {{$Mahasiswa->nim}}</h6>
                <h6><span class="text-bold">Kelas: </span> {{$Mahasiswa->kelas->nama_kelas}}</h6>
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

@endsection