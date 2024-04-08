<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MatchingController extends Controller
{
    public function getMatches()
    {
        try {
            $user = Auth::user();

            if (!$user->preference) {
                return response()->json(['msg' => 'El usuario no tiene preferencias'], 404);
            }

            $matches = User::findMatchesForUser($user);

            if ($matches->isEmpty()) {
                return response()->json(['msg' => 'No se han encontrado perfiles que superen el 70% de compatibilidad'], 404);
            }

            $response = $this->buildResponse($matches, $user->preference);
            return response()->json(['matches' => $response], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    private function buildResponse($matches, $userPreference)
    {
        $response = [];
        $weights = json_decode(file_get_contents(resource_path('config/weights.json')), true);

        foreach ($matches as $match) {
            $matchingPercentage = $this->calculateMatchingPercentage($userPreference, $match->preference, $weights);
            $response[] = [
                'name' => $match->name,
                'birthdate' => $match->preference->birthdate,
                'description' => $match->profile->description,
                'image' => $match->profile->image,
                'matchingPercentage' => $matchingPercentage,
            ];
        }

        return $response;
    }

    private function getExcludedFields($weights)
{
    $excludedFields = [];

    foreach ($weights as $field => $weight) {
        if ($weight === 0) {
            $excludedFields[] = $field;
        }
    }

    $excludedFields = array_merge($excludedFields, ['id', 'created_at', 'updated_at']);

    return $excludedFields;
}

private function getPreferenceFields($userPreference, $weights)
{
    $excludedFields = $this->getExcludedFields($weights);
    $fields = array_keys($userPreference->getAttributes());

    $fields = array_diff($fields, $excludedFields);

    return $fields;
}

private function calculateMatchingPercentage($userPreference, $matchPreference, $weights)
{
    $matchingFields = 0;

    foreach ($this->getPreferenceFields($userPreference, $weights) as $field) {
        if ($userPreference->$field === $matchPreference->$field) {
            $matchingFields += $weights[$field];
        }
    }

    $maxPossibleScore = array_sum($weights);

    $matchingPercentage = ($matchingFields / $maxPossibleScore) * 100;

    return $matchingPercentage;
}

}
