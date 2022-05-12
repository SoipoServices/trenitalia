<?php

namespace Soiposervices\Trenitalia\Tests\Unit;

use Illuminate\Support\Carbon;
use Soiposervices\Trenitalia\Tests\Unit\TestCase;
use Soiposervices\Trenitalia\TrenitaliaFacade;
use Illuminate\Support\Facades\Http;
use Soiposervices\Trenitalia\Enum\Direction;

class TrenitaliaApiSolutionsTest extends TestCase
{
    /** @test */
    function it_get_solutions()
    {

        $response  = [
            [
                "idsolution" => "1c02fc7de4fbfe4e5301531c8d97b051i0",
                "origin" => "Cagliari-Elmas",
                "destination" => "Cagliari",
                "direction" => "A",
                "departuretime" => 1652361060000,
                "arrivaltime" => 1652361720000,
                "minprice" => 0,
                "optionaltext" => null,
                "duration" => "00:11",
                "changesno" => 0,
                "bookable" => false,
                "saleable" => false,
                "trainlist" => [
                    [
                        "trainidentifier" => "Regionale 5155",
                        "trainacronym" => "REG",
                        "traintype" => "R",
                        "pricetype" => "D"
                    ]
                ],
                "onlycustom" => false,
                "extraInfo" => [],
                "showSeat" => true,
                "specialOffer" => null,
                "transportMeasureList" => [],
                "originalPrice" => 0
            ]
        ];



        Http::fake([
            TrenitaliaFacade::getApiRootUrl() . "*" =>  Http::response($response, 200)
        ]);

        $solution = TrenitaliaFacade::getSolutions("CAGLIARI-ELMAS","CAGLIARI", Direction::ONE_WAY, Carbon::now() )->first();

        $this->assertEquals("1c02fc7de4fbfe4e5301531c8d97b051i0", $solution->idsolution);
        $this->assertEquals("Cagliari-Elmas", $solution->origin);
        $this->assertEquals("Cagliari", $solution->destination);
        $this->assertEquals("2022-05-12 13:11:00", $solution->departuretime->toDateTimeString());
        $this->assertEquals("2022-05-12 13:22:00", $solution->arrivaltime->toDateTimeString());
        $this->assertEquals(0.0, $solution->minprice);
        $this->assertEquals("", $solution->optionaltext);
        $this->assertEquals("00:11", $solution->duration);
        $this->assertEquals(0, $solution->changesno);
        $this->assertEquals(false, $solution->bookable);
        $this->assertEquals(false, $solution->saleable);
        $this->assertEquals(false, $solution->onlycustom);
        $this->assertEquals(0, $solution->extraInfo->count());
        $this->assertEquals(true, $solution->showSeat);
        $this->assertEquals("", $solution->specialOffer);
        $this->assertEquals(0, $solution->transportMeasureList->count());
        $this->assertEquals(0, $solution->originalPrice);

        $trainlist = $solution->trainlist->first();

        $this->assertEquals("Regionale 5155", $trainlist->trainidentifier);
        $this->assertEquals("REG", $trainlist->trainacronym);
        $this->assertEquals("R", $trainlist->traintype);
        $this->assertEquals("D", $trainlist->pricetype);
        
    }


}
