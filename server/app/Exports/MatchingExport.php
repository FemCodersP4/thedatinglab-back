<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class MatchingExport implements FromCollection
{
    protected $matches;

    public function __construct(Collection $matches)
    {
        $this->matches = $matches;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = $this->matches->map(function ($match) {
            return [
                'Id'=> $match['id'],
                'Nombre' => $match['name'],
                'Apellido' => $match['lastname'],
                'Correo electrónico' => $match['email'], 
            ];
        });


        return $data;
    }
}