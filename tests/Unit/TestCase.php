<?php

namespace Soiposervices\Trenitalia\Tests\Unit;

use Soiposervices\Trenitalia\TrenitaliaServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
  public function setUp(): void
  {
    parent::setUp();
    // additional setup
  }

  protected function getPackageProviders($app)
  {
    return [
        TrenitaliaServiceProvider::class,
    ];
  }

  protected function getEnvironmentSetUp($app)
  {
    // perform environment setup
  }
  
}