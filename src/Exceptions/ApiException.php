<?php 

namespace Soiposervices\Trenitalia\Exceptions;

use Exception;

class ApiException extends Exception
{
    public function __construct(
        public int $status, 
        public string $messate,
        public string $response 
    ) {}
}