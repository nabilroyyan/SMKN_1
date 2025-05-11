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
                            <h5 class="mb-0">MONITORING Absensi <small class="text-muted">(urutan terbaru)</small></h5>
                            <div class="py-3"></div>
                            <a href="{{ route('monitoring.peringatan') }}" class="btn btn-warning y-3 ">Lihat Peringatan</a>
                        </div>
                        <form method="GET" action="{{ route('monitoring.index') }}" class="mb-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama Siswa</label>
                                    <input type="text" name="nama_siswa" class="form-control" placeholder="Cari nama siswa..." value="{{ request('nama_siswa') }}">
                                </div>
                                <div class="col-md-3">
                                    <label>Nama Jurusan</label>
                                    <input type="text" name="jurusan" class="form-control" placeholder="Cari nama jurusan..." value="{{ request('jurusan') }}">
                                </div>
                                <div class="col-md-3">
                                    <label>Nama Pelanggaran</label>
                                    <input type="text" name="nama_pelanggaran" class="form-control" placeholder="Cari nama pelanggaran..." value="{{ request('nama_pelanggaran') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                                </div>
                                <div class="col-md-2">
                                    <label>Bulan</label>
                                    <select name="bulan" class="form-control">
                                        <option value="">Pilih Bulan</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Tahun</label>
                                    <input type="number" name="tahun" class="form-control" placeholder="Contoh: 2024" value="{{ request('tahun') }}">
                                </div>
                            </div>
                            <div class="col-md-3 mt-4">
                                <button type="submit" class="btn btn-primary mt-2">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Siswa
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kelas
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Pelanggaran
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Skor
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Catatan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pelanggaran as $index => $p)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $index + 1 }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $p->siswa->nama_siswa }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0"> 
                                                @foreach ($p->siswa->kelas as $kelas)
                                                    {{ $kelas->jurusan }}<br>
                                                @endforeach
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $p->tanggal ?? '-' }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $p->skor_pelanggaran->nama_pelanggaran ?? '-' }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $p->skor_pelanggaran->skor ?? '-' }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $p->ket_pelanggaran ?? '-' }}</p>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-muted" colspan="4">No data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-4 py-2">
                        {{ $pelanggaran->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
