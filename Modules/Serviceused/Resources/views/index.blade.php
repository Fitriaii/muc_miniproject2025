@extends('master')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fw-bold text-dark">Serviceused List</h2>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>All Serviceused</span>

                    <a href="{{ route('serviceused.create') }}" class="btn btn-purple d-inline-flex align-items-center gap-2 px-4 py-2" data-bs-toggle="modal" data-bs-target="#createServiceused">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Tambah Serviceused
                    </a>
                </div>
                <div class="card-body">
                    @if($services->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Proposal number</th>
                                        <th>Nama Service</th>
                                        <th>Status Serviceused</th>
                                        <th>Timespent</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $serviceused)
                                        <tr>
                                            <td>{{ $serviceused->proposal->number }}</td>
                                            <td>{{ $serviceused->service_name ?? '-' }}</td>
                                            <td>
                                                @php
                                                    $status = $serviceused->status ?? '-';
                                                    $badgeClass = match($status) {
                                                        'pending' => 'bg-warning text-dark',
                                                        'ongoing' => 'bg-info text-light',
                                                        'done' => 'bg-success text-light',
                                                        default => 'bg-secondary text-light',
                                                    };
                                                @endphp

                                                <span class="badge {{ $badgeClass }}">
                                                    {{ ucfirst($status) }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $serviceused->duration ?? '-' }}
                                            </td>
                                            <td>
                                                <button type="button"
                                                        class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editServiceused-{{ $serviceused->id }}">
                                                    Edit
                                                </button>

                                                <form action="{{ route('serviceused.destroy', $serviceused->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @foreach($services as $serviceused)
                                <div class="modal fade" id="editServiceused-{{ $serviceused->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Serviceused</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form action="{{ route('serviceused.update', $serviceused->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="proposal_id" class="form-label">Proposal Number</label>
                                                        <select class="form-select" name="proposal_id" required>
                                                            @foreach($proposalList as $proposal)
                                                            <option value="{{ $proposal->id }}"
                                                                {{ $serviceused->proposal_id == $proposal->id ? 'selected' : '' }}>
                                                                {{ $proposal->number }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="service_name" class="form-label">Nama Service</label>
                                                        <input type="text" class="form-control" name="service_name" value="{{ $serviceused->service_name }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select class="form-select" name="status" required>
                                                            <option value="pending" {{ $serviceused->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="ongoing" {{ $serviceused->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                                            <option value="done" {{ $serviceused->status == 'done' ? 'selected' : '' }}>Done</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Serviceused</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    @else
                        <div class="alert alert-info">
                            No serviceused found.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('serviceused::create',['proposalList' => $proposalList])

@endsection
