@extends('layouts.user_type.auth')

@section('content')

<div> 
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h4>Tambah Siswa ke Kelas : {{ $kelas->jurusan }}</h4>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('kelas.add-siswa', $kelas->id) }}" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="container mt-4">    
                        <form action="{{ route('kelas.add-siswa', $kelas->id) }}" method="POST">
                            @csrf
                        
                            <div class="mb-3">
                                <label class="form-label">Pilih Siswa</label>
                        
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Pilih</th>
                                            <th>Nama Siswa</th>
                                            <th>NISN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($siswas as $siswa)
                                            <tr>
                                                <td>
                                                    <center>
                                                        <input class="text-center" type="checkbox" name="siswa_ids[]" value="{{ $siswa->id }}">
                                                    </center>
                                                </td>
                                                <td>{{ $siswa->nama_siswa }}</td>
                                                <td>{{ $siswa->nisn }}</td>    
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada siswa yang tersedia</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Tambah ke Kelas</button>
                            <a href="{{ route('kelas.show', $kelas->id) }}" class="btn btn-secondary">Kembali</a>
                        </form>
                        
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection