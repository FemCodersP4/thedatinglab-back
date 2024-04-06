<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PreferencesExport;
use App\Exports\AttendanceExport;
use App\Models\Event;

class ExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function export(){
        return Excel::download(new PreferencesExport, 'preferences.xlsx');
    }

    public function exportEventAttendance()
    {
        return Excel::download(new AttendanceExport(), 'event_attendance.xlsx');
    }
}
