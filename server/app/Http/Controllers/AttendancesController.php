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

        // Verificar si el usuario ya está registrado para este evento
        if ($event->confirmAttendance()->where('user_id', $user->id)->exists()) {
            return response()->json([
                'res' => false,
                'msg' => 'Ya estás registrado para este evento.'
            ]);
        }
        
        // Adjuntar al usuario al evento
        $event->confirmAttendance()->attach($user);

        $confirmedDate = now(); // Cambiado para registrar la fecha actual de confirmación
        
        // Enviar correo electrónico de confirmación
        Mail::to($user)->send(new ConfirmAttendance($user, $event));

        return response()->json([
            'res' => true,
            'confirmedDate' => $confirmedDate,
            'msg' => 'Te has registrado correctamente para el evento. Se ha enviado un correo electrónico de confirmación.'
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
