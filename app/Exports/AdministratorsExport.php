<?php

namespace App\Exports;

use App\Administrator;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AdministratorsExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collection = collect([]);
        $administrators = Administrator::all();

        $i = 0;
        foreach ($administrators as $admin) {
            $collection->push([
                ++$i,
                $admin->name,
                $admin->email,
                $admin->is_active
            ]);
        }

        return $collection;
    }

    /**
     * Encabezado de la tabla
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            '#',
            __('messages.name'),
            __('messages.email'),
            __('messages.is_active')
        ];
    }

    /**
     * Personalizar celdas
     *
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:D1'; // Celdas del encabezado
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12)->setBold(true); // Tamaño 12 y en negrita
            },
        ];
    }
}
