<?php

namespace Anakadote\BAMLT\Facades;
 
use Illuminate\Support\Facades\Facade;
 
class BAMLT extends Facade {
 
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'bamlt'; }
}
