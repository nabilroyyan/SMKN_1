@extends('layouts.user_type.auth')

@section('content')

<div>

    @if (session('message'))
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            @if (session('message'))
            <div class="alert">
                {{ session('message') }}
            </div>
        @endif
        </span>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Users</h5>
                        </div>
                        <a href="{{ route('user.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New User</a>
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
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        role
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $index => $user)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $index + 1 }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->role }}</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at->format('d-m-Y') }}</span>
                                        </td>
                                        <td class="text-center d-flex justify-content-center align-items-center gap-2">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('user.destroy', $user->id) }}" method="POST">
                                          <a href="{{ route('user.edit', $user->id) }}"
                                             class="btn btn-sm btn-primary">EDIT</a>
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                      </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-muted" colspan="6">Data user tidak tersedia</td>
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