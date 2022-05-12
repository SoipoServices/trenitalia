<?php

namespace Soiposervices\Trenitalia;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Soiposervices\Trenitalia\Skeleton\SkeletonClass
 */
class TrenitaliaFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'trenitalia';
    }
}
