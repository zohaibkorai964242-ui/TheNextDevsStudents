<?php

namespace App\Http\Controllers\student;
use App\Http\Controllers\Controller;
use App\Models\Attendance;


class MyAttendacesController extends Controller
{
	/**
	 * Show the My Attendances page for the student.
	 *
	 * @return \Illuminate\View\View
	 */
	public function my_attendances()
	{
        // Get the current timestamp for today at midnight
        $todayStart = strtotime('today');
        $todayEnd = strtotime('tomorrow') - 1;

        // Retrieve tutors with schedules starting within today
        $page_data['my_attendances'] = Attendance::where('student_id', auth()->user()->id)->where('start_time', '>=', $todayStart)->orderBy('id', 'desc')->paginate(10);

        $page_data['my_attendances'] = Attendance::where('student_id', auth()->user()->id)->where('start_time', '<', $todayStart)->orderBy('id', 'desc')->paginate(10);

        $view_path = 'frontend.' . get_frontend_settings('theme') . '.student.my_attendances.index';
        return view($view_path, $page_data);
		return view('frontend.default.student.my_attendances.index');
	}

}
