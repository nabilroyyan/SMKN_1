@extends('layouts.user_type.auth')

@section('content')

<div> 
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Create New Kelas') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('kelas.store') }}" method="POST" role="form text-left" enctype="multipart/form-data">
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
                                <label for="nama_kelas" class="form-control-label">{{ __('Nama Kelas') }}</label>
                                <input class="form-control" value="{{ old('nama_kelas') }}" type="text" placeholder="Nama Kelas" name="nama_kelas">
                                @error('nama_kelas')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jurusan" class="form-control-label">{{ __('Jurusan') }}</label>
                                <input class="form-control" value="{{ old('jurusan') }}" type="text" placeholder="Jurusan" name="jurusan">
                                @error('jurusan')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tinkat" class="form-control-label">{{ __('Tingkat') }}</label>
                                <select name="tinkat" class="form-control">
                                    <option value="">-- Pilih Tingkat --</option>
                                    <option value="1" {{ old('tinkat') == '1' ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ old('tinkat') == '2' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ old('tinkat') == '3' ? 'selected' : '' }}>3</option>
                                </select>
                                @error('tinkat')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_guru" class="form-control-label">{{ __('Guru') }}</label>
                                <select name="id_guru" class="form-control">
                                    <option value="">-- Pilih Guru --</option>
                                    @foreach($gurus as $g)
                                        <option value="{{ $g->id }}" {{ old('id_guru') == $g->id ? 'selected' : '' }}>{{ $g->nama_guru }}</option>
                                    @endforeach
                                </select>
                                @error('id_guru')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_users" class="form-control-label">{{ __('SEKRETARIS') }}</label>
                                <select name="id_users" class="form-control">
                                    <option value="">-- Pilih sekretaris --</option>
                                    @if(isset($users) && $users->count() > 0)
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('id_users') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>Data tidak tersedia</option>
                                    @endif
                                </select>
                                @error('id_users')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">
                            {{ 'Save Changes' }}
                        </button>
                        
                        <a href="{{ route('kelas.index') }}" class="btn bg-gradient-secondary btn-md mt-4 mb-4 ms-2">
                            {{ 'Back' }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection