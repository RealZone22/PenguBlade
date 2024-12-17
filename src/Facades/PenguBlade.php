<?php

namespace RealZone22\PenguBlade\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RealZone22\PenguBlade\PenguBlade
 */
class PenguBlade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \RealZone22\PenguBlade\PenguBlade::class;
    }
}
