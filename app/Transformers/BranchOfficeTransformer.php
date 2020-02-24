<?php

namespace App\Transformers;

use App\BranchOffice;
use League\Fractal\TransformerAbstract;

class BranchOfficeTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(BranchOffice $branchOffice)
    {
        return [
            'id'         => (int)$branchOffice->id,
            'name'       => (string)$branchOffice->name,
            'address'    => (string)$branchOffice->address,
            'created_at' => (string)$branchOffice->created_at
        ];
    }
}
