@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Absensi Kelas: {{ $kelas->jurusan }}</h6>
            <p class="text-sm mb-0">Tanggal: {{ $hari_ini }}</p>
        </div>
        <div class="card-body pt-4 p-3">
            <!-- Pesan error -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Pesan sukses -->
            @if(session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h4>Validasi Surat Sakit/Izin</h4>

            @forelse($absensis as $absensi)
            <div class="card mb-3 border shadow-sm">
                <div class="card-body">
                    <div class="row align-items-start">
                        <!-- Kolom kiri: Data -->
                        <div class="col-md-8">
                            <p><strong>Nama:</strong> {{ $absensi->siswa->nama_siswa }}</p>
                            <p><strong>Status:</strong> {{ $absensi->status }}</p>
                            <p><strong>Tanggal:</strong> {{ $absensi->hari_tanggal }}</p>
            
                            <form action="{{ route('absensi.approve', $absensi->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="{{ route('absensi.reject', $absensi->id) }}" method="POST" class="d-inline ms-2">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </div>
            
                        <!-- Kolom kanan: Gambar -->
                        <div class="col-md-4 text-center">
                            <p><strong>Surat:</strong></p>
                            <a href="{{ asset('storage/' . $absensi->foto_surat) }}" target="_blank">
                                <img src="{{ asset('storage/' . $absensi->foto_surat) }}" width="200" class="img-thumbnail" style="cursor: zoom-in;" alt="Surat">
                            </a>
                        </div>
                    </div>
                </div>
            </div>            
            @empty
                <p class="text-center">Tidak ada surat yang menunggu validasi.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
