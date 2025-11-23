@extends('master')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fw-bold text-dark">Proposal List</h2>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>All Proposal</span>

                    <a href="{{ route('proposal.create') }}" class="btn btn-purple d-inline-flex align-items-center gap-2 px-4 py-2" data-bs-toggle="modal" data-bs-target="#createProposal">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Tambah Proposal
                    </a>
                </div>
                <div class="card-body">
                    @if($proposals->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Year</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proposals as $proposal)
                                        <tr>
                                            <td>{{ $proposal->number }}</td>
                                            <td>{{ $proposal->year ?? '-' }}</td>
                                            <td>{{ $proposal->description ?? '-' }}</td>
                                            <td>{{ $proposal->status ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    @else
                        <div class="alert alert-info">
                            No employees found.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('proposal::create')

@endsection
