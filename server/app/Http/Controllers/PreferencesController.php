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
            'looksFor' => ['required', 'in:mujer,hombre,no binario,todo'],
            'ageRange' => ['required', 'in:20-30,25-35,35-45,no importa'],
            'sexoAffective' => ['required', 'in:monogama,explorar,abierta,beneficios,fluir,casual'],
            'heartState' => ['required', 'in:maduro,solo,feliz,recuperarse,despechado'],
            'hasChildren' => ['required', 'in:si,no'],
            'datesParents' => ['required', 'in:si,no,no sabe'],
            'values1' => ['required','in:amabilidad,amistad,autenticidad,aventura,comunicacion,conciencia,confianza,creatividad,cuidado,desarrollo'],
            'values2' => ['required','in:diversion,empatia,familia,fidelidad,generosidad,gratitud,honestidad,humildad,integridad,inteligencia'],
            'values3' => ['required','in:lealtad,libertad,optimismo,resiliencia,respeto,responsabilidad,afectiva,sencillez,humor,valentia'],
            'prefers1' => ['required','in:netflix,eventos,gym,todas'],
            'prefers2' => ['required','in:vino,cafe,agua,segun,ninguna'],
            'catsDogs' => ['required','in:gato,perro,de amigos'],
            'rrss' => ['required', 'string'],

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
            'hasChildren' => $request->input('hasChildren'),
            'datesParents' => $request->input('datesParents'),
            'values1' => $request->input('values1'),
            'values2' => $request->input('values2'),
            'values3' => $request->input('values3'),
            'prefers1' => $request->input('prefers1'),
            'prefers2' => $request->input('prefers2'),
            'catsDogs' => $request->input('catsDogs'),
            'rrss' => $request->input('rrss'),

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
            'looksFor' => ['required', 'in:mujer,hombre,no binario,todo'],
            'ageRange' => ['required', 'in:20-30,25-35,35-45,no importa'],
            'sexoAffective' => ['required', 'in:monogama,explorar,abierta,beneficios,fluir,casual'],
            'heartState' => ['required', 'in:maduro,solo,feliz,recuperarse,despechado'],
            'hasChildren' => ['required', 'in:si,no'],
            'datesParents' => ['required', 'in:si,no,no sabe'],
            'values1' => ['required','in:amabilidad,amistad,autenticidad,aventura,comunicacion,conciencia,confianza,creatividad,solidaridad,cuidado,desarrollo'],
            'values2' => ['required','in:diversion,empatia,familia,fidelidad,generosidad,gratitud,honestidad,humildad,integridad,inteligencia'],
            'values3' => ['required','in:lealtad,libertad,optimismo,resiliencia,respeto,responsabilidad,afectiva,sencillez,solidaridad,humor,valentia'],
            'prefers1' => ['required','in:netflix,eventos,gym,todas'],
            'prefers2' => ['required','in:vino,cafe,agua,segun,ninguna'],
            'catsDogs' => ['required','in:gato,perro,de amigos'],
            'rrss' => ['required', 'string'],
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
