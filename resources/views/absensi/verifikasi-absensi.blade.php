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
                        <p><strong>Nama:</strong> {{ $absensi->siswa->nama_siswa }}</p>
                        <p><strong>Status:</strong> {{ $absensi->status }}</p>
                        <p><strong>Tanggal:</strong> {{ $absensi->hari_tanggal }}</p>
                        <p><strong>Surat:</strong><br>
                            <img src="{{ asset('storage/' . $absensi->foto_surat) }}" width="200" alt="Surat">
                        </p>
                        <form action="{{ route('absensi.approve', $absensi->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="{{ route('absensi.reject', $absensi->id) }}" method="POST" class="d-inline ms-2">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center">Tidak ada surat yang menunggu validasi.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
