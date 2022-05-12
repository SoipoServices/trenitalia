<?php 

namespace Soiposervices\Trenitalia\Models;

use Illuminate\Support\Collection;

class Price
{
    public function __construct(
        public string $idsolution,
        public Collection $leglist,
        public float $totalprice, 
        public Collection $extraInfo,
    ) {}
}

