<?php

namespace RealZone22\PenguBlade\Services\PenguBlade;

use FeatureNinja\Cva\ClassVarianceAuthority;

class AlertCvaService
{
    public static function new(): ClassVarianceAuthority
    {
        return ClassVarianceAuthority::new(
            ['flex w-full items-center gap-2 p-4'],
            [
                'variants' => [
                    'color' => [
                        'info' => 'bg-sky-500/10 p-4',
                        'success' => 'bg-green-500/10',
                        'warning' => 'bg-amber-500/10',
                        'error' => 'bg-red-500/10',
                    ],
                ],
                'defaultVariants' => [
                    'color' => 'primary',
                ],
            ],
        );
    }
}
