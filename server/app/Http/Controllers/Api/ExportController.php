<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PreferencesExport;
use App\Exports\AttendanceExport;
use App\Models\Event;
use App\Exports\MatchingExport;
use App\Models\User;

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

    public function exportMatches($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $matches = User::findMatchesForUser($user);

        $export = new MatchingExport($matches);

        return Excel::download($export, 'matches_' . $user->id . '.xlsx');
    }
}
