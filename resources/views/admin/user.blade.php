@extends('admin.layouts.app')

@section('title', 'User')

@section('content')

    <div class="container mt-5">
        <h1 class="mt-4">User</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Form Search -->
        <form method="GET" action="{{ route('user.index') }}" class="mb-3">
            <div class="input-group">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search users..."
                    value="{{ request('search') }}"
                >
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Telephone</th>
                <th scope="col">Alamat</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($users as $index => $user)
                <tr>
                    <th scope="row">{{ $users->firstItem() + $index }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telephone }}</td>
                    <td>{{ $user->alamat }}</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="btn btn-sm btn-danger"
                                @if ($user->id === auth()->id()) disabled @endif
                                title="@if ($user->id === auth()->id()) Anda tidak dapat menghapus akun sendiri @else Hapus User @endif"
                            >
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No users found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        {{ $users->withQueryString()->links() }}

    </div>
@endsection
