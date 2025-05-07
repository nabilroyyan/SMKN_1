@extends('layouts.user_type.auth')

@section('content')
<div class="row mt-3">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header">
                <h5 class="mb-0">Daftar Peringatan Skor Pelanggaran</h5>
                <a href="{{ route('monitoring.index') }}" class="btn btn-secondary btn-sm mt-2">← Kembali ke Monitoring</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-bordered align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="text-center">Nama Siswa</th>
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Total Skor</th>
                                <th class="text-center">Status Peringatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswaList as $siswa)
                                <tr>
                                    <td class="ps-4">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $siswa->nama_siswa }}</td>
                                    <td class="text-center">
                                        @foreach ($siswa->kelas as $kelas)
                                            {{ $kelas->jurusan }}<br>
                                        @endforeach
                                    </td>
                                    <td class="text-center">{{ $totalSkor[$siswa->id] ?? 0 }}</td>
                                    <td class="text-center">
                                        @php
                                        $skor = $totalSkor[$siswa->id] ?? 0;
                                    @endphp
                                    
                                    @if ($skor >= 1000)
                                        @if ($siswa->sudah_ditindak)
                                            <span class="badge" style="background-color: #3498db;">Sudah Dilakukan Tindakan</span>
                                            <div class="mt-2"> <!-- Menambahkan margin-top untuk pemisahan -->
                                                <form action="{{ route('monitoring.tindakan.hapus', $siswa->tindakan->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin mau hapus tindakan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus Tindakan</button>
                                                </form>
                                            </div>
                                        @else
                                            <a href="{{ route('monitoring.tindakan', ['id' => $siswa->id]) }}" class="btn btn-sm btn-danger">Ambil Tindakan</a>
                                        @endif
                                    @elseif ($skor >= 500)
                                        <span class="text-warning font-weight-bold">Peringatan</span>
                                    @else
                                        <span class="text-success font-weight-bold">Aman</span>
                                    @endif
                                    
                                    </td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
