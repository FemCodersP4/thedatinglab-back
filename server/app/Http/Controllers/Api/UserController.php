<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Preference;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except('destroy', 'show');
    }
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function getPreferences($userId)
    {
        $user = User::findOrFail($userId);

        $preferences = $user->preference;


        if ($preferences) {
            return response()->json($preferences);
        } else {
            return response()->json(['message' => 'No se encontraron preferencias para el usuario.'], 404);
        }
    }

    public function destroy($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'Usuario eliminado con éxito',
        ], 200);
    }
}
