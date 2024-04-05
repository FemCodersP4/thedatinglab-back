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

    public function exportEventAttendance($eventId)
    {
        $event = Event::find($eventId);

        if (!$event) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        $attendees = $event->confirmAttendance()->with('profile')->get();

        return Excel::download(new AttendanceExport($attendees), 'event_attendance.xlsx');
    }
}
