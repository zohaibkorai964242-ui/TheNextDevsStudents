@extends('layouts.default')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h3>{{ get_phrase('Your Attendance QR') }}</h3>
                <div class="my-4">{!! $qrcode !!}</div>
                <p class="text-muted">Show this QR code to the scanner to mark attendance.</p>
            </div>
        </div>
    </div>
@endsection
