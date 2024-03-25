<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PreferencesController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'birthdate' => [
                'required','date',
                function ($attribute, $value, $fail) {
                    $currentDate = date('Y-m-d');
                    $birthdate = date_create($value);
                    $age = date_diff(date_create($currentDate), $birthdate)->y;
                    if ($age < 18) {
                        $fail('Tienes que ser mayor de 18 años para ingresar.');
                    } },],
            'ageRange' => ['required', 'in:18-25,26-35,36-45,Más de 45'],
            'gender' => ['required', 'in:Hombre,Mujer,No binario'],
            'looksFor' => ['required', 'in:Hombre,Mujer,No binario,Todo'],
            'hasChildren' => ['required', 'in:Sí,No'],
            'wantsFamily' => ['required', 'in:Sí,No'],
            'datesParents' => ['required', 'in:Sí,No,No me lo he planteado'],
            'sexoAffective' => ['required', 'in:Monógama,Monógama en la que explorar,Abierta,Amigos con derecho a roce,Lo que surja,Casual'],
            'heartState' => ['required', 'in:Maduro y sereno y dispuesto a compartirlo,Un poco solito,Feliz y palpitante con ganas de conocer,Acabo de salir de una relacion y busco recuperarme y distraerme,Más despechado que Shakira y Piqué,Otra'],
            'preferences1' => ['required', 'in:Netflix,Eventos,Deporte,Escapadas,Todas,Otras'],
            'preferences2' => ['required', 'in:Alcohol,Bebidas calientes,Refrescos,Según,Ninguna'],
            'catsDogs' => ['required', 'in:Gatos,Perros,Todos,De amigos'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ], 422);
        } else {
        
        $user = Auth::user();
        $preference = new Preference([
            'birthdate' => $request->input('birthdate'),
            'ageRange' => $request->input('ageRange'),
            'gender' => $request->input('gender'),
            'looksFor' => $request->input('looksFor'),
            'hasChildren' => $request->input('hasChildren'),
            'wantsFamily' => $request->input('wantsFamily'),
            'datesParents' => $request->input('datesParents'),
            'sexoAffective' => $request->input('sexoAffective'),
            'heartState' => $request->input('heartState'),
            'preferences1' => $request->input('preferences1'),
            'preferences2' => $request->input('preferences2'),
            'catsDogs' => $request->input('catsDogs'),
        ]);

        $preference->save();

        DB::table('users')
              ->where('id', $user->id)
              ->update(['preference_id' => $preference->id]);

        return response()->json([
            'message' => 'Preferencia creada correctamente'
        ], 201);
    }
}

}
