@extends('layouts.user_type.auth')

@section('content')
<div class="container mt-4">
    <h4>Ambil Tindakan Untuk: {{ $siswa->nama_siswa }}</h4>
    <p>Kelas: 
        @foreach ($siswa->kelas as $kelas)
            {{ $kelas->jurusan }}<br>
        @endforeach
    </p>

    <form method="POST" action="{{ route('monitoring.simpanTindakan') }}">
        @csrf
        <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
        <div class="form-group">
            <label for="tindakan">Pilih Tindakan:</label>
            <select name="tindakan" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="Panggilan Orang Tua">Panggilan Orang Tua</option>
                <option value="Menghadap Tata Tertib">Menghadap Tata Tertib</option>
                <option value="Diskors">Diskors</option>
                <option value="Kerja Sosial">Kerja Sosial</option>
                <option value="Surat Peringatan">Surat Peringatan</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="catatan">Catatan (opsional):</label>
            <textarea name="catatan" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan Tindakan</button>
    </form>
</div>
@endsection
