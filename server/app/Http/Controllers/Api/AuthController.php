<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Preference;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\Register;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'privacyPolicies' => 'required|accepted',
            'over18' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ], 422);
        } else {

            $preferenceId = $request->input('preference_id');
            $profileId = $request->input('profile_id');

            if ($preferenceId !== null && $profileId !== null) {
                $preference = Preference::find($preferenceId);
                $profile = Profile::find($profileId);
            } else {
                $preference = null;
                $profile = null;
            }

            $user = new User([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'lastname' => $request->input('lastname'),
                'password' => Hash::make($request->input('password')),
                'profile_id' => $profile ? $profile->id : null,
                'preference_id' => $preference ? $preference->id : null,
            ]);

            $user->save();

            $token = $user->createToken('auth_token')->plainTextToken;

            Mail::to($user)->send(new Register($user));

            return response()->json([
                'message' => 'Usuario creado correctamente',
                'user' => $user,
                'token' => $token,
            ], 201);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'msg' => 'Usuario o contraseña incorrectos'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $cookie = cookie('token', $token, 60 * 24);

        $isAdmin = $user->hasRole('admin');

        $userData = [
            'email' => $user->email,
            'name' => $user->name,
            'isAdmin' => $isAdmin,
            'id' => $user->id,
            'profile_id' => $user->profile_id,
            'preference_id' => $user->preference_id, 

        ];

        if ($user->profile) {
            $userData['profile_image'] = $user->profile->image;
        }

        return response()->json([
            'msg' => 'Usuario conectado exitosamente',
            'user' => $userData,
            'token' => $token
        ], 200)->withCookie($cookie);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'msg' => 'Usuario desconectado exitosamente'
        ], 200);
    }
}
