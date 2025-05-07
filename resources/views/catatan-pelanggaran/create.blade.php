@extends('layouts.user_type.auth')

@section('content')

<div> 
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Create New Pelanggaran') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('pelanggaran.store') }}" method="POST" role="form text-left" enctype="multipart/form-data">
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
                    @if(session('message'))
                        <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('message') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <input type="hidden" name="id_users" value="{{ Auth::id() }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_skor_pelanggaran" class="form-control-label">{{ __('nama Pelanggaran') }}</label>
                                <select name="id_skor_pelanggaran" class="form-control">
                                    <option value="">-- Pilih Pelanggaran --</option>
                                    @foreach($skors as $skor)
                                        <option value="{{ $skor->id }}" {{ old('id_skor_pelanggaran') == $skor->id ? 'selected' : '' }}>{{ $skor->nama_pelanggaran }}</option>
                                    @endforeach
                                </select>
                                @error('id_skor_pelanggaran')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bukti_pelanggaran" class="form-control-label">{{ __('Bukti Pelanggaran') }}</label>
                                <input class="form-control" type="file" name="bukti_pelanggaran">
                                @error('bukti_pelanggaran')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_siswa" class="form-control-label">{{ __('Siswa') }}</label>
                                <select name="id_siswa" class="form-control">
                                    <option value="">-- Pilih Siswa --</option>
                                    @foreach($siswas as $siswa)
                                        <option value="{{ $siswa->id }}" {{ old('id_siswa') == $siswa->nama_siswa ? 'selected' : '' }}>{{ $siswa->nama_siswa }}</option>
                                    @endforeach
                                </select>
                                @error('id_siswa')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ket_pelanggaran" class="form-control-label">{{ __('Keterangan Pelanggaran') }}</label>
                                <textarea class="form-control" name="ket_pelanggaran" placeholder="Keterangan Pelanggaran">{{ old('ket_pelanggaran') }}</textarea>
                                @error('ket_pelanggaran')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal" class="form-control-label">{{ __('Tanggal') }}</label>
                            <input class="form-control" value="{{ old('tanggal') }}" type="date" name="tanggal">
                            @error('tanggal')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        </div>
                    </div>
    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">
                            {{ 'Save Changes' }}
                        </button>
                        
                        <a href="{{ route('pelanggaran.index') }}" class="btn bg-gradient-secondary btn-md mt-4 mb-4 ms-2">
                            {{ 'Back' }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection