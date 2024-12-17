<?php

namespace RealZone22\PenguBlade\Services\PenguBlade;

use FeatureNinja\Cva\ClassVarianceAuthority;

class SpinnerCvaService
{
    public static function new(): ClassVarianceAuthority
    {
        return ClassVarianceAuthority::new(
            ['size-5 animate-spin motion-reduce:animate-none'],
            [
                'variants' => [
                    'color' => [
                        'primary' => 'fill-black dark:fill-white',
                        'secondary' => 'fill-neutral-800 dark:fill-neutral-300',
                        'alternate' => 'fill-neutral-300 dark:fill-neutral-700',
                        'inverse' => 'fill-neutral-950 dark:fill-white',
                        'info' => 'fill-sky-500 dark:fill-sky-500',
                        'danger' => 'fill-red-500 dark:fill-red-500',
                        'warning' => 'fill-amber-500 dark:fill-amber-500',
                        'success' => 'fill-green-500 dark:fill-green-500',
                    ],
                ],
                'defaultVariants' => [
                    'color' => 'primary',
                ],
            ],
        );
    }
}
