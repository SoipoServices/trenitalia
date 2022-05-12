<?php

namespace Soiposervices\Trenitalia\Tests\Unit;

use Soiposervices\Trenitalia\Tests\Unit\TestCase;
use Soiposervices\Trenitalia\TrenitaliaFacade;
use Illuminate\Support\Facades\Http;


class TrenitaliaApiSolutionInfoTest extends TestCase
{

    /** @test */
    function it_find_a_solution_info()
    {

        $response = [
            [
                "idsolution" => "1c02fc7de4fbfe4e5301531c8d97b051i1",
                "idleg" => "x10876842-16a6-4f66-aef4-12d26dfd1623",
                "direction" => "A",
                "trainidentifier" => "Regionale 20817",
                "trainacronym" => "REG",
                "departurestation" => "CAGLIARI-ELM",
                "departuretime" => 1652364840000,
                "arrivalstation" => "CAGLIARI",
                "arrivaltime" => 1652365560000,
                "duration" => "00:12"
            ]
        ];

        Http::fake([
            TrenitaliaFacade::getApiRootUrl() . "*" =>  Http::response($response, 200)
        ]);


        $solutionInfo = TrenitaliaFacade::getSolutionInfo("1c02fc7de4fbfe4e5301531c8d97b051i0")->first();
        
        $this->assertEquals("1c02fc7de4fbfe4e5301531c8d97b051i1", $solutionInfo->idsolution);
        $this->assertEquals("x10876842-16a6-4f66-aef4-12d26dfd1623", $solutionInfo->idleg);
        $this->assertEquals("A", $solutionInfo->direction);
        $this->assertEquals("Regionale 20817", $solutionInfo->trainidentifier);
        $this->assertEquals("REG", $solutionInfo->trainacronym);
        $this->assertEquals("CAGLIARI-ELM", $solutionInfo->departurestation);
        $this->assertEquals("2022-05-12 14:14:00", $solutionInfo->departuretime->toDateTimeString());
        $this->assertEquals("CAGLIARI", $solutionInfo->arrivalstation);
        $this->assertEquals("2022-05-12 14:26:00", $solutionInfo->arrivaltime->toDateTimeString());
        $this->assertEquals("00:12", $solutionInfo->duration);
    }
}
