@extends('layouts.user_type.auth')

@section('content')

<div> 
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Create New Skor Pelanggaran') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('skor-pelanggaran.store') }}" method="POST" role="form text-left">
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_pelanggaran" class="form-control-label">{{ __('Nama Pelanggaran') }}</label>
                                <input class="form-control" value="{{ old('nama_pelanggaran') }}" type="text" placeholder="Nama Pelanggaran" name="nama_pelanggaran">
                                @error('nama_pelanggaran')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="skor" class="form-control-label">{{ __('Skor') }}</label>
                                <input class="form-control" value="{{ old('skor') }}" type="number" placeholder="Skor" name="skor" min="1">
                                @error('skor')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_pelanggaran" class="form-control-label">{{ __('Jenis Pelanggaran') }}</label>
                                <select name="jenis_pelanggaran" class="form-control">
                                    <option value="">-- Pilih Jenis Pelanggan --</option>
                                    <option value="ringan" {{ old('jenis_pelanggaran') == 'ringan' ? 'selected' : '' }}>Ringan</option>
                                    <option value="sedang" {{ old('jenis_pelanggaran') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                    <option value="berat" {{ old('jenis_pelanggaran') == 'berat' ? 'selected' : '' }}>Berat</option>
                                </select>
                                @error('jenis_pelanggaran')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">
                            {{ 'Save Changes' }}
                        </button>
                        
                        <a href="{{ route('skor-pelanggaran.index') }}" class="btn bg-gradient-secondary btn-md mt-4 mb-4 ms-2">
                            {{ 'Back' }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
