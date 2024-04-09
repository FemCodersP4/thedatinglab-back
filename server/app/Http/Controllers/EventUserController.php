<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventUserController extends Controller
{
    public function register(Request $request)
    {
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);

        
        $user = User::find($request->user_id);
        $event = Event::find($request->event_id);

        
        $user->events()->attach($event);

        return response()->json(['message' => 'User registered for event successfully'], 200);
    }

}
