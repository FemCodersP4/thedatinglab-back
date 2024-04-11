<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class AttendanceExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        return DB::table('event_user')
            ->join('users', 'event_user.user_id', '=', 'users.id')
            ->join('events', 'event_user.event_id', '=', 'events.id')
            ->select(
                'users.name as User',
                'users.lastname as Apellidos',
                'users.email as Email',
                'events.title as Evento',
                'events.description as Descripción',
                'events.location as Lugar',
                'events.date as Fecha del Evento',
                'events.time as Hora'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nombre Usuario',
            'Apellido Usuario',
            'Email Usuario',
            'Titulo Evento',
            'Descripción',
            'Lugar',
            'Fecha del Evento',
            'Hora del Evento',
        ];
    }
}
