@extends('admin.layouts.app')

@section('title', 'Parameter')

@section('content')
    <div class="container mt-5">
        <h1 class="mt-4">Parameter</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('parameter.index') }}" class="mb-3">
            <div class="input-group">
                {{-- Tombol Add --}}
                <button
                    type="button"
                    class="btn btn-success"
                    data-bs-toggle="modal"
                    data-bs-target="#addParameterModal"
                >
                    Add Parameter
                </button>
                {{-- Dropdown filter --}}
                <select name="type" class="form-select" onchange="this.form.submit()">
                    <option value="payment" {{ $type == 'payment' ? 'selected' : '' }}>Payment</option>
                    <option value="shipment" {{ $type == 'shipment' ? 'selected' : '' }}>Shipment</option>
                </select>
            </div>
        </form>

        <table class="table table-striped mt-4">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Code</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td>
{{--                        <a href="{{ route('parameter.edit', ['type' => $type, 'id' => $item->id]) }}" class="btn btn-warning btn-sm">Edit</a>--}}
                        <button type="button"
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editParameterModal"
                                data-id="{{ $item->id }}"
                                data-code="{{ $item->code }}"
                                data-name="{{ $item->name }}">
                            Edit
                        </button>
                        <form action="{{ route('parameter.destroy', ['type' => $type, 'id' => $item->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No {{ $type }} data found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
{{--        <div class="d-flex justify-content-center">--}}
{{--            {{ $data->withQueryString()->links() }}--}}
{{--        </div>--}}

        <!-- Add Product Modal -->
        @include('admin.components.add-parameter-modal')

        @foreach ($data as $item)
            @include('admin.components.edit-parameter-modal', ['item' => $item])
        @endforeach
{{--        @include('admin.components.edit-parameter-modal')--}}

{{--    </div>--}}
        @push('scripts')
            <script>
                setTimeout(function () {
                    const alertSuccess = document.querySelector('.alert-success');
                    if (alertSuccess) {
                        alertSuccess.style.transition = 'opacity 0.5s ease';
                        alertSuccess.style.opacity = '0';
                        setTimeout(() => alertSuccess.remove(), 500); // Hapus setelah fade out
                    }
                }, 3000); // 3000ms = 3 detik

                const editModal = document.getElementById('editParameterModal');
                editModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;

                    const id = button.getAttribute('data-id');
                    const code = button.getAttribute('data-code');
                    const name = button.getAttribute('data-name');
                    const type = "{{ $type }}";


                    // Isi input modal dengan data
                    editModal.querySelector('#edit-id').value = id;
                    editModal.querySelector('#edit-code').value = code;
                    editModal.querySelector('#edit-name').value = name;

                    // Set form action URL
                    const form = document.getElementById('editParameterForm');

                    if (form) {
                        form.action = `/parameter/${type}/${id}`;
                    } else {
                        console.error("Form editParameterForm tidak ditemukan!");
                    }
                });
            </script>
        @endpush
@endsection
