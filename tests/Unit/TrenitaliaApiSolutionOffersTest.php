<?php

namespace Soiposervices\Trenitalia\Tests\Unit;

use Soiposervices\Trenitalia\Tests\Unit\TestCase;
use Soiposervices\Trenitalia\TrenitaliaFacade;
use Illuminate\Support\Facades\Http;


class TrenitaliaApiSolutionOffersTest extends TestCase
{

    /** @test */
    function it_find_a_solution_offers()
    {

        $response =  [
            "idSolution" => "1c02fc7de4fbfe4e5301531c8d97b051i4",
            "leglist" => [
                [
                    "idleg" => "xb2c94d79-8f5e-4432-9fc3-dc83aa69ecad",
                    "bookingtype" => "N",
                    "segments" => [
                        [
                            "trainidentifier" => "Regionale 4937",
                            "trainacronym" => "REG",
                            "departurestation" => "Cagliari-Elmas",
                            "departuretime" => "2022-05-12T18:43:00.000+02:00",
                            "arrivalstation" => "Cagliari",
                            "arrivaltime" => "2022-05-12T18:53:00.000+02:00",
                            "nodexmlid" => "xb2c94d79-8f5e-4432-9fc3-dc83aa69ecad",
                            "showseatmap" => false
                        ]
                    ],
                    "travelerlist" => [
                        [
                            "travelertype" => "A",
                            "travelerLoyaltyType" => "N",
                            "servicelist" => [
                                [
                                    "name" => "2ª CLASSE",
                                    "sid" => 201,
                                    "selected" => true,
                                    "offerlist" => [
                                        [
                                            "name" => "ORDINARIA",
                                            "extraInfo" => [],
                                            "points" => 0.65,
                                            "price" => 1.3,
                                            "message" => "",
                                            "credentials" => null,
                                            "available" => 32767,
                                            "visible" => true,
                                            "selected" => true,
                                            "specialOffers" => [],
                                            "standingPlace" => false,
                                            "seatToPay" => false,
                                            "disableSeatmapSelection" => false,
                                            "transportMeasure" => null,
                                            "description" => "Il biglietto acquistato è già convalidato con la data e l'ora di partenza scelta dal cliente. I biglietti possono avere diverse validità in base alle disposizioni regionali. Cambio e rimborso sono ammessi salvo diverse disposizioni regionali.",
                                            "fareTypeCredential" => false,
                                            "offerid" => [
                                                "xmlid" => "xfa8c3bb7-72fd-462e-9ef2-776240b8547f",
                                                "price" => 1.3,
                                                "eligible" => true,
                                                "messages" => []
                                            ]
                                        ],
                                        [
                                            "name" => "Viaggia con me",
                                            "extraInfo" => [],
                                            "points" => 0.65,
                                            "price" => 1.3,
                                            "message" => "",
                                            "credentials" => [
                                                [
                                                    "credentialid" => 267,
                                                    "format" => 1,
                                                    "name" => "Numero Abbonamento",
                                                    "description" => "Numero abbonamento regionale per offerta Viaggia con me",
                                                    "possiblevalues" => [],
                                                    "typeCredential" => "S"
                                                ]
                                            ],
                                            "available" => 32767,
                                            "visible" => true,
                                            "selected" => false,
                                            "specialOffers" => [],
                                            "standingPlace" => false,
                                            "seatToPay" => false,
                                            "disableSeatmapSelection" => false,
                                            "transportMeasure" => null,
                                            "description" => "La promozione \"Viaggia con me\" consente all'intestatario dell'abbonamento riportato nel biglietto di corsa semplice di viaggiare gratuitamente, insieme al titolare del biglietto di corsa semplice",
                                            "fareTypeCredential" => false,
                                            "offerid" => [
                                                "xmlid" => "xe870fa1d-f68b-419a-817e-a81acdb8486a",
                                                "price" => 1.3,
                                                "eligible" => true,
                                                "messages" => []
                                            ]
                                        ],
                                        [
                                            "name" => "Viaggia con me Integrato",
                                            "extraInfo" => [],
                                            "points" => 0.65,
                                            "price" => 1.3,
                                            "message" => "",
                                            "credentials" => [
                                                [
                                                    "credentialid" => 264,
                                                    "format" => 1,
                                                    "name" => "NOME TITOLARE ABBONAMENTO",
                                                    "description" => "Credenziale per nome titolare abbonamento da riportare su offerta Viaggia con me",
                                                    "possiblevalues" => [],
                                                    "typeCredential" => "S"
                                                ],
                                                [
                                                    "credentialid" => 265,
                                                    "format" => 1,
                                                    "name" => "COGNOME TITOLARE ABBONAMENTO",
                                                    "description" => "Credenziale per cognome titolare abbonamento da riportare su offerta Viaggia con me",
                                                    "possiblevalues" => [],
                                                    "typeCredential" => "S"
                                                ],
                                                [
                                                    "credentialid" => 266,
                                                    "format" => 2,
                                                    "name" => "DATA DI NASCITA TITOLARE ABBONAMENTO",
                                                    "description" => "Credenziale per data di nascita titolare abbonamento da riportare su offerta Viaggia con me",
                                                    "possiblevalues" => [],
                                                    "typeCredential" => "S"
                                                ]
                                            ],
                                            "available" => 32767,
                                            "visible" => true,
                                            "selected" => false,
                                            "specialOffers" => [],
                                            "standingPlace" => false,
                                            "seatToPay" => false,
                                            "disableSeatmapSelection" => false,
                                            "transportMeasure" => null,
                                            "description" => "La promozione \"Viaggia con me\" consente all'intestatario dell'abbonamento riportato nel biglietto di corsa semplice di viaggiare gratuitamente, insieme al titolare del biglietto di corsa semplice",
                                            "fareTypeCredential" => false,
                                            "offerid" => [
                                                "xmlid" => "xe6801d39-320d-40d8-b0a4-32ac3d827286",
                                                "price" => 1.3,
                                                "eligible" => true,
                                                "messages" => []
                                            ]
                                        ],
                                        [
                                            "name" => "STUDENTI VALLE D'AOSTA",
                                            "extraInfo" => [],
                                            "points" => 0.65,
                                            "price" => 1.3,
                                            "message" => "",
                                            "credentials" => [
                                                [
                                                    "credentialid" => 22,
                                                    "format" => 1,
                                                    "name" => "NUMERO MATRICOLA",
                                                    "description" => "NUMERO_MATRICOLA",
                                                    "possiblevalues" => null,
                                                    "typeCredential" => null
                                                ],
                                                [
                                                    "credentialid" => 23,
                                                    "format" => 1,
                                                    "name" => "CARD CHECK",
                                                    "description" => "CARD_CHECK",
                                                    "possiblevalues" => null,
                                                    "typeCredential" => null
                                                ]
                                            ],
                                            "available" => 32767,
                                            "visible" => true,
                                            "selected" => false,
                                            "specialOffers" => [],
                                            "standingPlace" => false,
                                            "seatToPay" => false,
                                            "disableSeatmapSelection" => false,
                                            "transportMeasure" => null,
                                            "description" => "",
                                            "fareTypeCredential" => false,
                                            "offerid" => [
                                                "xmlid" => "xddd9de72-a8fa-4da4-87e4-8da5c90899b1",
                                                "price" => 1.3,
                                                "eligible" => true,
                                                "messages" => []
                                            ]
                                        ],
                                        [
                                            "name" => "C.Argento Rail PLUS",
                                            "extraInfo" => [],
                                            "points" => 0.65,
                                            "price" => 1.3,
                                            "message" => "",
                                            "credentials" => [
                                                [
                                                    "credentialid" => 2,
                                                    "format" => 1,
                                                    "name" => "NUMERO CARTA",
                                                    "description" => "numero carta ADPL",
                                                    "possiblevalues" => null,
                                                    "typeCredential" => null
                                                ]
                                            ],
                                            "available" => 32767,
                                            "visible" => true,
                                            "selected" => false,
                                            "specialOffers" => [],
                                            "standingPlace" => false,
                                            "seatToPay" => false,
                                            "disableSeatmapSelection" => false,
                                            "transportMeasure" => null,
                                            "description" => "",
                                            "fareTypeCredential" => false,
                                            "offerid" => [
                                                "xmlid" => "xcaaa8d19-50e7-46fb-ad31-9a78fa5472c8",
                                                "price" => 1.3,
                                                "eligible" => true,
                                                "messages" => []
                                            ]
                                        ],
                                        [
                                            "name" => "C. Spec. III isol.",
                                            "extraInfo" => [],
                                            "points" => 0.65,
                                            "price" => 1.3,
                                            "message" => "",
                                            "credentials" => [
                                                [
                                                    "credentialid" => 8,
                                                    "format" => 1,
                                                    "name" => "NUMERO CARTA",
                                                    "description" => "Carta Concessione spec.III isolata e titolare",
                                                    "possiblevalues" => null,
                                                    "typeCredential" => null
                                                ]
                                            ],
                                            "available" => 32767,
                                            "visible" => true,
                                            "selected" => false,
                                            "specialOffers" => [],
                                            "standingPlace" => false,
                                            "seatToPay" => false,
                                            "disableSeatmapSelection" => false,
                                            "transportMeasure" => null,
                                            "description" => "",
                                            "fareTypeCredential" => false,
                                            "offerid" => [
                                                "xmlid" => "xc218e3c9-e13f-4503-877f-dccf4426884e",
                                                "price" => 1.3,
                                                "eligible" => true,
                                                "messages" => []
                                            ]
                                        ],
                                        [
                                            "name" => "C. Verde Rail PLUS",
                                            "extraInfo" => [],
                                            "points" => 0.65,
                                            "price" => 1.3,
                                            "message" => "",
                                            "credentials" => [
                                                [
                                                    "credentialid" => 1,
                                                    "format" => 1,
                                                    "name" => "NUMERO CARTA",
                                                    "description" => "numero carta VDPL",
                                                    "possiblevalues" => null,
                                                    "typeCredential" => null
                                                ]
                                            ],
                                            "available" => 32767,
                                            "visible" => true,
                                            "selected" => false,
                                            "specialOffers" => [],
                                            "standingPlace" => false,
                                            "seatToPay" => false,
                                            "disableSeatmapSelection" => false,
                                            "transportMeasure" => null,
                                            "description" => "",
                                            "fareTypeCredential" => false,
                                            "offerid" => [
                                                "xmlid" => "xe26b52bf-7e60-4726-906d-6cf81c957495",
                                                "price" => 1.3,
                                                "eligible" => true,
                                                "messages" => []
                                            ]
                                        ]
                                    ],
                                    "credentials" => null,
                                    "showSeatMap" => false,
                                    "message" => "",
                                    "postiInPiedi" => false
                                ]
                            ],
                            "travelxmlid" => "xfa4d1c72-9bac-48bf-8b49-5190005fb5a3",
                            "name" => null,
                            "surname" => null
                        ]
                    ],
                    "sameAvailableService" => true,
                    "trainidentifier" => "Regionale 4937",
                    "trainacronym" => "REG",
                    "departurestation" => "Cagliari-Elmas",
                    "departuretime" => 1652373780000,
                    "arrivalstation" => "Cagliari",
                    "arrivaltime" => 1652374380000
                ],
                null
            ],
            "totalprice" => 1.3,
            "extraInfo" => []
        ];



        Http::fake([
            TrenitaliaFacade::getApiRootUrl() . "*" =>  Http::response($response, 200)
        ]);


        $offer = TrenitaliaFacade::getCustomizedoffers("1c02fc7de4fbfe4e5301531c8d97b051i4");

        $this->assertEquals("1c02fc7de4fbfe4e5301531c8d97b051i4", $offer->idsolution);
        $this->assertEquals(1.3, $offer->totalprice);
        $this->assertEquals(2, $offer->leglist->count());
        $this->assertEquals(0, $offer->extraInfo->count());
    }
}
