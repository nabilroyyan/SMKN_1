@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid">
    </div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('user.update', $user) }}" method="POST" role="form text-left">
                    @method('PUT')
                    @csrf
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
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
                                <label for="name" class="form-control-label">{{ __('name') }}</label>
                                <div class="@error('email') is-invalid @enderror">
                                    <input class="form-control" value="{{ old('name', $user->name) }}" type="text" placeholder="Name" id="name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ old('email', $user->email) }}" type="email" placeholder="@example.com" id="email" name="email">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role" class="form-control-label">{{ __('Role') }}</label>
                                <div class="@error('role') is-invalid @enderror">
                                    <select name="role" class="form-control" id="role">
                                        <option disabled selected>Pilih Role</option>
                                        <option value="superadmin" {{ old('role', $user->role) == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                                        <option value="wakel" {{ old('role', $user->role) == 'wakel' ? 'selected' : '' }}>Wali Kelas</option>
                                        <option value="sekretaris_kelas" {{ old('role', $user->role) == 'sekretaris_kelas' ? 'selected' : '' }}>Sekretaris Kelas</option>
                                        <option value="bk" {{ old('role', $user->role) == 'bk' ? 'selected' : '' }}>BK</option>
                                        <option value="tatip" {{ old('role', $user->role) == 'tatip' ? 'selected' : '' }}>Tata Tertib</option>
                                        <option value="siswa" {{ old('role', $user->role) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                    </select>                                    
                                    @error('role')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <di<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="form-control-label">{{ __('Password Baru (opsional)') }}</label>
                                <div class="@error('password') is-invalid @enderror">
                                    <input class="form-control" type="password" placeholder="Kosongkan jika tidak ingin mengganti password" name="password">
                                    @error('password')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation" class="form-control-label">{{ __('Konfirmasi Password Baru') }}</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru jika mengisi">
                            </div>
                        </div>
                    </div>                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection