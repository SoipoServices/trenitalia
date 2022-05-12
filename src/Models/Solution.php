<?php 

namespace Soiposervices\Trenitalia\Models;

use DateTime;
use Soiposervices\Trenitalia\Enum\Direction;
use Illuminate\Support\Collection;

class Solution
{
    public function __construct(
        public string $idsolution, 
        public string $origin, 
        public string $destination, 
        public string $direction,
        public DateTime $departuretime,
        public DateTime $arrivaltime,
        public float $minprice,
        public string $optionaltext,
        public string $duration,
        public int $changesno,
        public bool $bookable,
        public bool $saleable,
        public Collection $trainlist,
        public bool $onlycustom,
        public Collection $extraInfo,
        public bool $showSeat,
        public string $specialOffer,
        public Collection $transportMeasureList,
        public float $originalPrice,
    ) {}
}