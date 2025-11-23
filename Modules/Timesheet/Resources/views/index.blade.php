@extends('master')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fw-bold text-dark">Timesheet List</h2>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>All Timesheet</span>
                </div>
                <div class="card-body">
                    @if($timesheets->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Karyawan</th>
                                        <th>Proposal Number</th>
                                        <th>Service Name</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Total Jam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($timesheets as $timesheet)
                                        <tr>
                                            <td>{{ $timesheet->date }}</td>
                                            <td>{{ $timesheet->employee->fullname ?? '-' }}</td>
                                            <td>{{ $timesheet->serviceused->proposal->number  ?? '-' }}</td>
                                            <td>{{ $timesheet->serviceused->service_name ?? '-' }}</td>
                                            <td>{{ $timesheet->timestart ?? '-' }}</td>
                                            <td>{{ $timesheet->timefinish ?? '-' }}</td>
                                            <td>{{ $timesheet->serviceused->duration ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    @else
                        <div class="alert alert-info">
                            No timesheet found.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
