@extends('layouts.user_type.auth')

@section('content')

<div>

    @if (session('success'))
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <div class="alert">
                {{ session('success') }}
            </div>
        </span>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h3>Detail Kelas: {{ $kelas->nama_kelas }}</h3>
                        </div>
                        </div>  
                        <div class="card-body">
                            <div class="d-flex flex-row justify-content-between">
                                <p><strong>Jurusan:</strong> {{ $kelas->jurusan }}</p>
                                <a href="{{ route('kelas.add-siswa.form', $kelas->id) }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tambah Siswa</a>
                            </div>
                            <p><strong>Tingkat:</strong> {{ $kelas->tinkat }}</p>
                            <p><strong>Wali Kelas:</strong> {{ $kelas->guru->nama_guru ?? 'Belum ada' }}</p>
                        </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                                                        
                            <table class="table align-items-center mb-0">
                                <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Daftar Siswa di Kelas Ini:</h5>
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Siswa</th>
                                        <th>NISN</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kelas->siswas as $index => $siswa)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $siswa->nama_siswa }}</td>
                                            <td>{{ $siswa->nisn }}</td>
                                            <td>
                                                <form action="{{ route('kelas.remove-siswa', [$kelas->id, $siswa->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa ini dari kelas?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                                                </form>
                                            </td>     
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Belum ada siswa di kelas ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
@endsection

