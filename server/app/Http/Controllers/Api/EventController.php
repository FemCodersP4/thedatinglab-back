<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except('index', 'show','getEventsPagination');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }


    public function getEventsPagination()
    {
        try{
            $events = Event::paginate(8);
            return response()->json($events, 200);

        }catch (\Exception $e) {
            return response()->json(['message' => 'Ha ocurrido un error al recuperar los eventos'], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'location'=> 'required|string|max:255',
            'shortDescription'=> 'required|string|max:500',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ], 422);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        $event = Event::create([
            'title' => $request->input('title'),
            'date' => $request->input('date'),
            'location'=> $request->input('location'),
            'shortDescription'=>$request->input('shortDescription'),
            'time' => $request->input('time'),
            'description' => $request->input('description'),
            'image' => $imagePath,
        ]);

        $adminUser = Auth::user();
        $event->user()->associate($adminUser);
        $event->save();

        return response()->json(['message' => 'Evento creado exitosamente', 'event' => $event]);
    }

    public function show($id)
{
    if (Auth::check()) {
        $event = Event::findOrFail($id);

        if ($event) {
            return response()->json($event);
        } else {
            return response()->json(['error' => 'Evento no encontrado'], 404);
        }
    } else {
        return response()->json(['error' => 'No autorizado'], 401);
    }
}

    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'location'=> 'required|string|max:255',
            'shortDescription'=> 'required|string|max:500',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $imagePath = $request->file('image')->store('storage', 'public');
            $validatedData['image'] = $imagePath;
        }

        $event->update($validatedData);

        return response()->json(['message' => 'Evento actualizado exitosamente', 'event' => $event]);
    }

    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully']);
    }
}
