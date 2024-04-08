<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventUserController extends Controller
{
    public function register(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);

        // Obtener el usuario y el evento
        $user = User::find($request->user_id);
        $event = Event::find($request->event_id);

        // Asociar el usuario al evento
        $user->events()->attach($event);

        return response()->json(['message' => 'User registered for event successfully'], 200);
    }

}
