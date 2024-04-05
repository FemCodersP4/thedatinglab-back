<?php

namespace App\Exports;

use App\Models\Preference;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PreferencesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::join('preferences', 'users.preference_id', '=', 'preferences.id')
            ->select(
                'users.name as User Name',
                'users.email as User Email',
                'preferences.*'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nombre Usuario',
            'Email Usuario',
            'Id',
            'Fecha de Nacimiento',
            'Genero',
            'Busca a',
            'Rango de edad',
            'Sexoafectividad',
            'Estado de corazon',
            'Tiene hijos',
            'Pareja con hijos',
            'Valores1',
            'Valores2',
            'Valores3',
            'Ocio1',
            'Ocio2',
            'Gato o perro',
            'RRSS',
        ];
    }
}
