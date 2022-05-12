<?php 

namespace Soiposervices\Trenitalia\Models;

class Train
{
    public function __construct(
        public string $trainidentifier, 
        public string $trainacronym, 
        public string $traintype,
        public string $pricetype
    ) {}
}