@extends('layouts.default')
@push('title', get_phrase('My Attendance'))
@push('meta')@endpush
@push('css')
<style>
    .attendance-wrapper {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(108, 99, 255, 0.08);
        padding: 28px;
        border: 1px solid #ede9ff;
    }

    .attendance-stats {
        display: flex;
        gap: 16px;
        margin-bottom: 28px;
        flex-wrap: wrap;
    }

    .stat-card {
        flex: 1;
        min-width: 120px;
        border-radius: 12px;
        padding: 18px 20px;
        text-align: center;
    }

    .stat-card.total   { background: #f3f0ff; border: 1px solid #c4b5fd; }
    .stat-card.present { background: #ecfdf5; border: 1px solid #6ee7b7; }
    .stat-card.absent  { background: #fef2f2; border: 1px solid #fca5a5; }
    .stat-card.rate    { background: #eff6ff; border: 1px solid #93c5fd; }

    .stat-card .stat-number {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 4px;
    }

    .stat-card.total   .stat-number { color: #6c63ff; }
    .stat-card.present .stat-number { color: #059669; }
    .stat-card.absent  .stat-number { color: #dc2626; }
    .stat-card.rate    .stat-number { color: #2563eb; }

    .stat-card .stat-label {
        font-size: 0.78rem;
        color: #6b7280;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .attendance-table-wrapper {
        overflow-x: auto;
        border-radius: 10px;
        border: 1px solid #f0ebff;
    }

    .attendance-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }

    .attendance-table thead tr {
        background: linear-gradient(90deg, #6c63ff, #a084e8);
        color: #fff;
    }

    .attendance-table thead th {
        padding: 13px 18px;
        text-align: left;
        font-weight: 600;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        white-space: nowrap;
    }

    .attendance-table tbody tr {
        border-bottom: 1px solid #f3f0ff;
        transition: background 0.15s;
    }

    .attendance-table tbody tr:hover {
        background: #faf7ff;
    }

    .attendance-table tbody tr:last-child {
        border-bottom: none;
    }

    .attendance-table tbody td {
        padding: 13px 18px;
        color: #374151;
        vertical-align: middle;
    }

    .badge-present {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #d1fae5;
        color: #065f46;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
    }

    .badge-absent {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #fee2e2;
        color: #991b1b;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
    }

    .badge-late {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #fef3c7;
        color: #92400e;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
    <section class="wishlist-content">
        <div class="profile-banner-area"></div>
        <div class="container profile-banner-area-container">
            <div class="row">
                @include('frontend.default.student.left_sidebar')

                <div class="col-lg-9">
                    <h4 class="g-title mb-4">{{ get_phrase('My Attendance') }}</h4>

                    <div class="attendance-wrapper">

                        {{-- Stats Cards (dummy data) --}}
                        <div class="attendance-stats">
                            <div class="stat-card total">
                                <div class="stat-number">24</div>
                                <div class="stat-label">{{ get_phrase('Total Classes') }}</div>
                            </div>
                            <div class="stat-card present">
                                <div class="stat-number">20</div>
                                <div class="stat-label">{{ get_phrase('Present') }}</div>
                            </div>
                            <div class="stat-card absent">
                                <div class="stat-number">4</div>
                                <div class="stat-label">{{ get_phrase('Absent') }}</div>
                            </div>
                            <div class="stat-card rate">
                                <div class="stat-number">83%</div>
                                <div class="stat-label">{{ get_phrase('Attendance Rate') }}</div>
                            </div>
                        </div>

                        {{-- Table (dummy data) --}}
                        <div class="attendance-table-wrapper">
                            <table class="attendance-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ get_phrase('Course') }}</th>
                                        <th>{{ get_phrase('Date') }}</th>
                                        <th>{{ get_phrase('Session') }}</th>
                                        <th>{{ get_phrase('Status') }}</th>
                                        <th>{{ get_phrase('Remarks') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Web Development Bootcamp</td>
                                        <td>01 Apr, 2025</td>
                                        <td>Morning Session</td>
                                        <td><span class="badge-present">&#10003; Present</span></td>
                                        <td>—</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Web Development Bootcamp</td>
                                        <td>03 Apr, 2025</td>
                                        <td>Morning Session</td>
                                        <td><span class="badge-absent">&#10007; Absent</span></td>
                                        <td>Sick leave</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>UI/UX Design Course</td>
                                        <td>05 Apr, 2025</td>
                                        <td>Evening Session</td>
                                        <td><span class="badge-present">&#10003; Present</span></td>
                                        <td>—</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>UI/UX Design Course</td>
                                        <td>07 Apr, 2025</td>
                                        <td>Evening Session</td>
                                        <td><span class="badge-late">&#9200; Late</span></td>
                                        <td>Arrived 15 mins late</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Web Development Bootcamp</td>
                                        <td>10 Apr, 2025</td>
                                        <td>Morning Session</td>
                                        <td><span class="badge-present">&#10003; Present</span></td>
                                        <td>—</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Python for Beginners</td>
                                        <td>12 Apr, 2025</td>
                                        <td>Afternoon Session</td>
                                        <td><span class="badge-absent">&#10007; Absent</span></td>
                                        <td>—</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Python for Beginners</td>
                                        <td>14 Apr, 2025</td>
                                        <td>Afternoon Session</td>
                                        <td><span class="badge-present">&#10003; Present</span></td>
                                        <td>—</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')@endpush