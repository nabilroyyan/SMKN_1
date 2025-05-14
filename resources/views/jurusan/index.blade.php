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
                            <h5 class="mb-0">Semua Jurusan</h5>
                        </div>
                        <a href="{{ route('jurusan.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;jurusan</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Jurusan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jurusan as $index => $violation)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $index + 1 }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $violation->nama_jurusan }}</p>
                                        </td>
                                        <td class="text-center d-flex justify-content-center align-items-center gap-2">
                                            <form action="{{ route('jurusan.destroy', $violation->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-muted" colspan="4">No violation data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
