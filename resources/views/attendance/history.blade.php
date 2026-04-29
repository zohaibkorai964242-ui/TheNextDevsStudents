@extends('layouts.default')

@section('content')
    <div class="container py-5">
        <h3>{{ get_phrase('My Attendance History') }}</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Scanned Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $att)
                        <tr>
                            <td>{{ optional($att->date)->format('d M, Y') }}</td>
                            <td>{{ optional($att->scanned_at)->format('h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">No attendance records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
