<?php 

namespace Soiposervices\Trenitalia\Models;

use DateTime;
use Soiposervices\Trenitalia\Enum\Direction;

class Info
{
    public function __construct(
        public string $idsolution, 
        public string $idleg, 
        public string $direction,
        public string $trainidentifier,
        public string $trainacronym,
        public string $departurestation,
        public DateTime $departuretime,
        public string $arrivalstation,
        public DateTime $arrivaltime,
        public string $duration,
    ) {}
}