<?php

namespace realzone22\PenguBlade\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \realzone22\PenguBlade\PenguBlade
 */
class PenguBlade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \realzone22\PenguBlade\PenguBlade::class;
    }
}
