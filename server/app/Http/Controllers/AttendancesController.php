<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ConfirmAttendance;
use Illuminate\Support\Facades\Mail;

class AttendancesController extends Controller
{
    public function confirmAttendance($id)
    {
        $user = Auth::user();
        $event = Event::find($id);
    
        if ($event->confirmAttendance()->where('user_id', $user->id)->exists()) {
            return response()->json(['message' => 'El usuario ya está confirmado para este evento'], 400);
        }
    
        $event->confirmAttendance()->attach($user);
        Mail::to($user)->send(new ConfirmAttendance($user, $event));
    
        $confirmedDate = now();
    
        return response()->json([
            'res' => true,
            'confirmedDate' => $confirmedDate,
        ]);
    }
    public function eventAttendees($id)
    {

        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        $attendees = $event->confirmAttendance()->with('profile')->get(); 

        return response()->json(['attendees' => $attendees], 200); 
    }

    public function getEventsForUser($userId)
    {

        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $event = $user->confirmAttendance()->get();

        return response()->json(['event' => $event], 200);
    }
}
