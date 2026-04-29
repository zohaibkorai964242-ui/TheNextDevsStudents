<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['generateQR', 'history']);
    }

    // Show the logged-in student's QR
    public function generateQR()
    {
        $user = Auth::user();

        if (! $user->qr_token) {
            $user->qr_token = bin2hex(random_bytes(20));
            $user->save();
        }

        $url = route('attendance.scan') . '?token=' . $user->qr_token;

        $qrcode = QrCode::size(300)->generate($url);

        return view('attendance.qr', compact('qrcode'));
    }

    // Handle scan
    public function scan(Request $request)
    {
        $token = $request->query('token');

        if (! $token) {
            return redirect()->route('home')->with('error', 'Invalid QR');
        }

        $user = User::where('qr_token', $token)->first();

        if (! $user) {
            return redirect()->route('home')->with('error', 'Invalid QR');
        }

        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', $user->id)->where('date', $today)->first();

        if ($attendance) {
            return redirect()->route('home')->with('info', 'Already marked today');
        }

        // Optional time window
        $now = Carbon::now();
        $start = Carbon::createFromTime(8, 0, 0);
        $end = Carbon::createFromTime(11, 0, 0);

        if (! ($now->between($start, $end))) {
            return redirect()->route('home')->with('error', 'Attendance is allowed only between 8 AM and 11 AM');
        }

        Attendance::create([
            'user_id' => $user->id,
            'date' => $today,
            'scanned_at' => Carbon::now(),
        ]);

        return redirect()->route('home')->with('success', 'Attendance marked');
    }

    // Show history for logged-in student
    public function history()
    {
        $user = Auth::user();

        $attendances = Attendance::where('user_id', $user->id)->orderBy('date', 'desc')->get();

        return view('attendance.history', compact('attendances'));
    }
}
