@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Absensi Kelas: {{ $kelas->jurusan }}</h6>
                <p class="text-sm mb-0">Tanggal: {{ $hari_ini }}</p>
            </div>
            <div class="card-body pt-4 p-3">
                <!-- Tampilkan pesan kesalahan atau keberhasilan -->
                    @if($errors->any())
                        <div class="mt-3 alert alert-primary alert-dismissible fade show" id="alert-error" role="alert">
                            <span class="alert-text text-white">{{ $errors->first() }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif

                    @if(session('message'))
                        <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">{{ session('message') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif

                    <h2>Validasi Surat Sakit/Izin</h2>

                    @foreach($absensis as $absensi)
                        <div style="margin-bottom: 20px; border-bottom: 1px solid #ccc;">
                            <p><strong>Nama:</strong> {{ $absensi->siswa->nama_siswa }}</p>
                            <p><strong>Status:</strong> {{ $absensi->status }}</p>
                            <p><strong>Tanggal:</strong> {{ $absensi->hari_tanggal }}</p>
                            <p><strong>Surat:</strong><br>
                                <img src="{{ asset('storage/' . $absensi->foto_surat) }}" alt="Surat" width="200">
                            </p>
                            <form action="{{ route('absensi.approve', $absensi->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit">Approve</button>
                            </form>
                            <form action="{{ route('absensi.reject', $absensi->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit">Reject</button>
                            </form>
                        </div>
                    @endforeach
                @endsection
                

