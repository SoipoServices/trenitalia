<?php

namespace Soiposervices\Trenitalia;

use DateTime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Soiposervices\Trenitalia\Enum\Direction;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Soiposervices\Trenitalia\Exceptions\ApiException;
use Soiposervices\Trenitalia\Models\Info;
use Soiposervices\Trenitalia\Models\Price;
use Soiposervices\Trenitalia\Models\Solution;
use Soiposervices\Trenitalia\Models\Station;
use Soiposervices\Trenitalia\Models\Train;

class Trenitalia
{
    public function getApiRootUrl(): string
    {
        return config("trenitalia.api_root_url");
    }

    private function convertTimestamp(string $timestamp): DateTime
    {
        return Carbon::createFromTimestamp(\Str::of($timestamp)->limit(10));
    }

    private function convertDirection(string $direction = null): string
    {
        return (Direction::ROUNTRIP == $direction) ? Direction::ROUNTRIP : Direction::ONE_WAY;
    }

    /**
     * @param string $origin The name of the departure station, as returned by the station auto-complete (see below)
     * @param string $destination The name of the arrival station
     * @param string $arflag  It can be 'A' or 'R', the first if you are looking for one-way trips, the second for round trips
     * @param DateTime $aDate Date in dd / mm / yyyy format
     * @param int $adultNumber  Respectively the number of adults or children to search for the trip
     * @param int $childrenNumber   Respectively the number of adults or children to search for the trip
     * @param string $direction It can be valid only 'A' if [AR] is 'A', otherwise it is worth 'A' or 'R' depending on whether you are looking for outward or return solutions on a return trip
     * @param bool $frecce  Boolean, 'true' to search only for solutions with high speed / regional trains, 'false' otherwise. Setting them both to true has no effect. (Yes, I tried: P)
     * @param $onlyRegional = false  Boolean, 'true' to search only for solutions with high speed / regional trains, 'false' otherwise. Setting them both to true has no effect. (Yes, I tried: P)
     * @param DateTime $rdate These fields are omitted if [AR] is 'A', otherwise they are the dual of [DATE] and [TIME] for the return journey
     * 
     * @return Collection
     */
    public function getSolutions(string $origin, string $destination, string $arflag, DateTime $aDate, int $adultNumber = 1, int $childrenNumber = 0, string $direction = null, bool $frecce = false, $onlyRegional = false, DateTime $rDate = null): ?Collection
    {

        $adate = $aDate->format("d/m/Y");
        $atime = $aDate->format("H");
        $rdate = "";
        $rtime = "";

        $arflag = $this->convertDirection($arflag);
        $direction = $this->convertDirection($direction);

        if ($arflag == Direction::ONE_WAY &&  !is_null($rDate)) {
            $rdate = $rDate->format("d/m/Y");
            $rtime = $rDate->format("H");
        }


        $url = "{$this->getApiRootUrl()}solutions?origin={$origin}&destination={$destination}&arflag={$arflag}&adate={$adate}&atime={$atime}&adultno={$adultNumber}&childno={$childrenNumber}&direction={$direction}&frecce={$frecce}&onlyRegional={$onlyRegional}&rdate={$rdate}&rtime={$rtime}";
        $response = Http::get($url);
        if ($response->ok()) {
            return $response->collect()->map(function ($solution) {
                return new Solution(
                    $solution["idsolution"],
                    $solution["origin"],
                    $solution["destination"],
                    $this->convertDirection($solution["direction"]),
                    $this->convertTimestamp($solution["departuretime"]),
                    $this->convertTimestamp($solution["arrivaltime"]),
                    floatval($solution["minprice"]),
                    !is_null($solution["optionaltext"]) ? $solution["optionaltext"] : "",
                    $solution["duration"],
                    intval($solution["changesno"]),
                    boolval($solution["bookable"]),
                    boolval($solution["saleable"]),
                    collect($solution["trainlist"])->map(function ($tain) {
                        return new Train(
                            $tain["trainidentifier"],
                            $tain["trainacronym"],
                            $tain["traintype"],
                            $tain["pricetype"],
                        );
                    }),
                    boolval($solution["onlycustom"]),
                    collect($solution["extraInfo"]),
                    intval($solution["showSeat"]),
                    !is_null($solution["specialOffer"]) ? $solution["specialOffer"] : "",
                    collect($solution["transportMeasureList"]),
                    floatval($solution["originalPrice"])
                );
            });
        } else {
            Log::warning($response->body());
            throw new ApiException($response->status(), "Could not load solutions", $response->body());
        }
    }

    /**
     * 
     * @param string $key A partial string representing a station
     * 
     * @return Collection
     */
    public function getLocations(string $key): ?Collection
    {
        $url = "{$this->getApiRootUrl()}geolocations/locations?name={$key}";
        $response = Http::get($url);
        if ($response->ok()) {
            return $response->collect()->map(function ($location) {
                return new Station($location["name"], $location["id"], collect($location["tags"]));
            });
        } else {
            Log::warning($response->body());
            throw new ApiException($response->status(), "Could not find locations", $response->body());
        }
    }

    /**
     * 
     * @param string $key A partial string representing a station
     * 
     * @return Collection
     */
    public function getSolutionInfo(string $solutionId): ?Collection
    {
        $url = "{$this->getApiRootUrl()}solutions/{$solutionId}/info";
        $response = Http::get($url);
        if ($response->ok()) {
            return $response->collect()->map(function ($solution) {
                return new Info(
                    $solution["idsolution"],
                    $solution["idleg"],
                    $this->convertDirection($solution["direction"]),
                    $solution["trainidentifier"],
                    $solution["trainacronym"],
                    $solution["departurestation"],
                    $this->convertTimestamp($solution["departuretime"]),
                    $solution["arrivalstation"],
                    $this->convertTimestamp($solution["arrivaltime"]),
                    $solution["duration"],
                );
            });
        } else {
            Log::warning($response->body());
            throw new ApiException($response->status(), "Could not find solution info", $response->body());
        }
    }

    /**
     * 
     * @param string $key A partial string representing a station
     * 
     * @return Price
     */
    public function getCustomizedoffers(string $solutionId): ?Price
    {
        $url = "{$this->getApiRootUrl()}solutions/{$solutionId}/customizedoffers";
        $response = Http::get($url);
        if ($response->ok()) {
            $offer = $response->json();
            return new Price(
                $offer["idSolution"],
                collect($offer["leglist"]),
                floatval($offer["totalprice"]),
                collect($offer["extraInfo"])
            );
        } else {
            Log::warning($response->body());
            throw new ApiException($response->status(), "Could not load customized offers", $response->body());
        }
    }
}
