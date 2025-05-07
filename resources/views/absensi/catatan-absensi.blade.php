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

                                {{-- FORM INPUT ABSENSI --}}
                                @if($siswasBelumAbsensi->isNotEmpty())
                                    <form action="{{ route('absensi.simpan', $kelas->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="hari_tanggal" value="{{ $hari_ini }}">
                
                                        <h6 class="mb-3">Form Absensi Siswa</h6>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Siswa</th>
                                                    <th>Status</th>
                                                    <th>Foto Surat (Izin/Sakit)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($siswasBelumAbsensi as $siswa)
                                                    <tr>
                                                        <td>{{ $siswa->nama_siswa }}</td>
                                                        <td>
                                                            <select name="absensi[{{ $siswa->id }}][status]" class="form-control" required>
                                                                <option value="hadir">Hadir</option>
                                                                <option value="izin">Izin</option>
                                                                <option value="sakit">Sakit</option>
                                                                <option value="alpha">Alpha</option>
                                                            </select>
                                                        </td>
                                                       
                                                        <td>
                                                            <input type="file" name="absensi[{{ $siswa->id }}][foto_surat]" class="form-control" accept="image/*">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                
                                        <button type="submit" class="btn btn-primary">Simpan Absensi</button>
                                    </form>
                                @else
                                    <div class="alert alert-info mt-3">Semua siswa sudah melakukan absensi hari ini.</div>
                                @endif
                
                                {{-- DAFTAR YANG SUDAH ABSEN --}}
                                <hr class="my-4">
                                <h6>Daftar Absensi Hari Ini</h6>
                                @if($absensiHariIni->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-items-center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Status</th>
                                                <th>Status Surat</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($absensiHariIni as $index => $absen)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $absen->siswa->nama_siswa }}</td>
                                                    <td>{{ ucfirst($absen->status) }}</td>
                                                    <td>{{ $absen->status_surat ?? '-' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($absen->hari_tanggal)->format('d-m-Y') }}</td>
                                                    <td>
                                                        <form action="{{ route('absensi.hapus', $absen->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus absensi ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                    <p class="text-muted">Belum ada data absensi hari ini.</p>
                                @endif
                
                            </div>
                        </div>
                    </div>
                </div>
                
                @endsection


