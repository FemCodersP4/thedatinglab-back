<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PreferencesController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except('store');
    }
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
            'gender' => ['required', 'in:mujer,hombre,no binario'],
            'looksFor' => ['required', 'in:mujeres,hombres,no binarias,todo'],
            'ageRange' => ['required', 'in:20-30,25-35,35-45,no importa'],
            'sexoAffective' => ['required', 'in:monogama,explorar,abierta,beneficios,fluir,casual'],
            'heartState' => ['required', 'in:maduro,solo,feliz,recuperarse,despechado'],
            'personalValues' => ['required','array','min:3', 'max:3','in:honestidad,respeto,responsabilidad,empatia,integridad,gratitud,generosidad,tolerancia,solidaridad,humildad,perseverancia,justicia'],
            'preferences1' => ['required', 'in:netflix,eventos,gym,escapadas,todas'],
            'preferences2' => ['required', 'in:alcohol,cafe,agua,ninguna,no alcohol'],
            'catsDogs' => ['required', 'in:gatos,perros,todos,no gustan'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ], 422);
        } else {

        $user = Auth::user();

        $preference = new Preference([
            'birthdate' => $request->input('birthdate'),
            'gender' => $request->input('gender'),
            'looksFor' => $request->input('looksFor'),
            'ageRange' => $request->input('ageRange'),
            'sexoAffective' => $request->input('sexoAffective'),
            'heartState' => $request->input('heartState'),
            'personalValues' => json_encode($request->input('personalValues')),
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

public function update(Request $request, $id)
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
                    }
                },
            ],
            'gender' => ['required', 'in:mujer,hombre,no binario'],
            'looksFor' => ['required', 'in:mujeres,hombres,no binarias,todo'],
            'ageRange' => ['required', 'in:20-30,25-35,35-45,no importa'],
            'sexoAffective' => ['required', 'in:monogama,explorar,abierta,beneficios,fluir,casual'],
            'heartState' => ['required', 'in:maduro,solo,feliz,recuperarse,despechado'],
            'personalValues' => ['required','array','min:3', 'max:3','in:honestidad,respeto,responsabilidad,empatia,integridad,gratitud,generosidad,tolerancia,solidaridad,humildad,perseverancia,justicia'],
            'preferences1' => ['required', 'in:netflix,eventos,gym,escapadas,todas'],
            'preferences2' => ['required', 'in:alcohol,cafe,agua,ninguna,no alcohol'],
            'catsDogs' => ['required', 'in:gatos,perros,todos,no gustan'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ], 422);
        } else {
            $preference = Preference::findOrFail($id);

            $preference->update($request->all());

            return response()->json([
                'message' => 'Preferencia actualizada correctamente'
            ]);
        }
    }

}
