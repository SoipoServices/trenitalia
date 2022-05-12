<?php 

namespace Soiposervices\Trenitalia\Models;
use Illuminate\Support\Collection;

class Station
{
    public function __construct(
        public string $name, 
        public string $id, 
        public Collection $tags,
    ) {}
}