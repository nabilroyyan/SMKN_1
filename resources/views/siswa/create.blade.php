@extends('layouts.user_type.auth')

@section('content')

<div> 
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Create New Siswa') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('siswa.store') }}" method="POST" role="form text-left" enctype="multipart/form-data">
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_siswa" class="form-control-label">{{ __('Nama Siswa') }}</label>
                                <input class="form-control" value="{{ old('nama_siswa') }}" type="text" placeholder="Nama Siswa" name="nama_siswa">
                                @error('nama_siswa')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nisn" class="form-control-label">{{ __('NISN') }}</label>
                                <input class="form-control" value="{{ old('nisn') }}" type="text" placeholder="NISN" name="nisn">
                                @error('nisn')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat" class="form-control-label">{{ __('Tempat Lahir') }}</label>
                                <input class="form-control" value="{{ old('tempat') }}" type="text" placeholder="Tempat Lahir" name="tempat">
                                @error('tempat')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir" class="form-control-label">{{ __('Tanggal Lahir') }}</label>
                                <input class="form-control" value="{{ old('tanggal_lahir') }}" type="date" name="tanggal_lahir">
                                @error('tanggal_lahir')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_kelamin" class="form-control-label">{{ __('Jenis Kelamin') }}</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="agama" class="form-control-label">{{ __('Agama') }}</label>
                                <input class="form-control" value="{{ old('agama') }}" type="text" placeholder="Agama" name="agama">
                                @error('agama')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status_dalam_keluarga" class="form-control-label">{{ __('Status Dalam Keluarga') }}</label>
                                <input class="form-control" value="{{ old('status_dalam_keluarga') }}" type="text" placeholder="Status Dalam Keluarga" name="status_dalam_keluarga">
                                @error('status_dalam_keluarga')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="anak_ke" class="form-control-label">{{ __('Anak Ke') }}</label>
                                <input class="form-control" value="{{ old('anak_ke') }}" type="number" placeholder="Anak Ke" name="anak_ke">
                                @error('anak_ke')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat_peserta_didik" class="form-control-label">{{ __('Alamat Peserta Didik') }}</label>
                                <textarea class="form-control" name="alamat_peserta_didik" placeholder="Alamat Peserta Didik">{{ old('alamat_peserta_didik') }}</textarea>
                                @error('alamat_peserta_didik')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomer_telepon_rumah" class="form-control-label">{{ __('Nomor Telepon Rumah') }}</label>
                                <input class="form-control" value="{{ old('nomer_telepon_rumah') }}" type="text" placeholder="Nomor Telepon Rumah" name="nomer_telepon_rumah">
                                @error('nomer_telepon_rumah')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sekolah_asal" class="form-control-label">{{ __('Sekolah Asal') }}</label>
                                <input class="form-control" value="{{ old('sekolah_asal') }}" type="text" placeholder="Sekolah Asal" name="sekolah_asal">
                                @error('sekolah_asal')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="diterima_disekolah_pada_tanggal" class="form-control-label">{{ __('Diterima di Sekolah Pada Tanggal') }}</label>
                                <input class="form-control" value="{{ old('diterima_disekolah_pada_tanggal') }}" type="date" name="diterima_disekolah_pada_tanggal">
                                @error('diterima_disekolah_pada_tanggal')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ayah" class="form-control-label">{{ __('Nama Ayah') }}</label>
                                <input class="form-control" value="{{ old('nama_ayah') }}" type="text" placeholder="Nama Ayah" name="nama_ayah">
                                @error('nama_ayah')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ibu" class="form-control-label">{{ __('Nama Ibu') }}</label>
                                <input class="form-control" value="{{ old('nama_ibu') }}" type="text" placeholder="Nama Ibu" name="nama_ibu">
                                @error('nama_ibu')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat_orangtua" class="form-control-label">{{ __('Alamat Orang Tua') }}</label>
                                <textarea class="form-control" name="alamat_orangtua" placeholder="Alamat Orang Tua">{{ old('alamat_orangtua') }}</textarea>
                                @error('alamat_orangtua')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan_ayah" class="form-control-label">{{ __('Pekerjaan Ayah') }}</label>
                                <input class="form-control" value="{{ old('pekerjaan_ayah') }}" type="text" placeholder="Pekerjaan Ayah" name="pekerjaan_ayah">
                                @error('pekerjaan_ayah')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan_ibu" class="form-control-label">{{ __('Pekerjaan Ibu') }}</label>
                                <input class="form-control" value="{{ old('pekerjaan_ibu') }}" type="text" placeholder="Pekerjaan Ibu" name="pekerjaan_ibu">
                                @error('pekerjaan_ibu')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto_siswa" class="form-control-label">{{ __('Foto Siswa') }}</label>
                                <input class="form-control" type="file" name="foto_siswa">
                                @error('foto_siswa')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">
                            {{ 'Save Changes' }}
                        </button>
                        
                        <a href="{{ route('siswa.index') }}" class="btn bg-gradient-secondary btn-md mt-4 mb-4 ms-2">
                            {{ 'Back' }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection