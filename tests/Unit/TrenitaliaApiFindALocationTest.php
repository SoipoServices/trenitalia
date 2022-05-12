<?php

namespace Soiposervices\Trenitalia\Tests\Unit;

use Soiposervices\Trenitalia\Tests\Unit\TestCase;
use Soiposervices\Trenitalia\TrenitaliaFacade;
use Illuminate\Support\Facades\Http;


class TrenitaliaApiFindALocationTest extends TestCase
{
    /** @test */
    function it_find_a_location()
    {
        
        $response = [
            [
                "name" => "ELMAS AEROPORTO",
                "id" => 830012819,
                "tags" => []
            ],
            [
                "name" => "CAGLIARI-ELMAS",
                "id" => 830012890,
                "tags" => []
            ]
        ];



        Http::fake([
            TrenitaliaFacade::getApiRootUrl() . "*" =>  Http::response($response, 200)
        ]);

        $stations = TrenitaliaFacade::getLocations("CAGL");
        $this->assertEquals(2, $stations->count());
        $cagliariStation = $stations->where("name", "CAGLIARI-ELMAS")->first();
        $this->assertEquals("CAGLIARI-ELMAS", $cagliariStation->name);
        $this->assertEquals("830012890", $cagliariStation->id);
        $this->assertEquals(0, $cagliariStation->tags->count());
    }

}
