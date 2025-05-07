@extends('layouts.user_type.auth')

@section('content')
<div class="row mt-3">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header">
                <h5 class="mb-0">Ubah Tindakan Siswa</h5>
                <a href="{{ route('monitoring.index') }}" class="btn btn-secondary btn-sm mt-2">← Kembali ke Monitoring</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form method="POST" action="{{ route('monitoring.tindakan.update', $siswa->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="status_tindakan" class="form-label">Status Tindakan</label>
                        <select name="status_tindakan" class="form-control">
                            <option value="Aman" {{ $siswa->tindakan->status_tindakan == 'Aman' ? 'selected' : '' }}>Aman</option>
                            <option value="Peringatan" {{ $siswa->tindakan->status_tindakan == 'Peringatan' ? 'selected' : '' }}>Peringatan</option>
                            <option value="Tindakan" {{ $siswa->tindakan->status_tindakan == 'Tindakan' ? 'selected' : '' }}>Tindakan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="catatan_tindakan" class="form-label">Catatan Tindakan</label>
                        <textarea name="catatan_tindakan" class="form-control">{{ $siswa->tindakan->catatan_tindakan }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
