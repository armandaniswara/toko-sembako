@extends('admin.layouts.app')

@section('title', 'Parameter')

@section('content')
    <div class="container mt-5">
        <h1 class="mt-4">Parameter</h1>

        <form method="GET" action="{{ route('parameter.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <select name="type" class="form-select" onchange="this.form.submit()">
                        <option disabled selected>-- Select Parameter Type --</option>
                        <option value="payment" {{ request('type') == 'payment' ? 'selected' : '' }}>Payment</option>
                        <option value="shipment" {{ request('type') == 'shipment' ? 'selected' : '' }}>Shipment</option>
                    </select>
                </div>
            </div>
        </form>

        @if(isset($data))
            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="{{ route('parameter.edit', ['type' => $type, 'id' => $item->id]) }}"
                               class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('parameter.destroy', ['type' => $type, 'id' => $item->id]) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete
                                </button>
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
        @endif
    </div>
@endsection
