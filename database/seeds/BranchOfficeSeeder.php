<?php

use App\BranchOffice;
use Illuminate\Database\Seeder;

class BranchOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BranchOffice::truncate(); // Eliminar los registros de la tabla

        $branchOffices = [
            [
                'name'    => 'Sucursal principal',
                'address' => 'San Salvador, San Salvador'
            ],
            [
                'name'    => 'Segunda sucursal',
                'address' => 'Zacatecoluca, La Paz'
            ]
        ];

        foreach ($branchOffices as $office) BranchOffice::create($office);
    }
}
