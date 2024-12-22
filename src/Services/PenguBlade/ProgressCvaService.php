<?php

namespace RealZone22\PenguBlade\Services\PenguBlade;

use FeatureNinja\Cva\ClassVarianceAuthority;

class ProgressCvaService
{
    public static function new(): ClassVarianceAuthority
    {
        return ClassVarianceAuthority::new(
            [],
            [
                'variants' => [
                    'color' => [
                        'primary' => 'bg-black dark:bg-white text-white dark:text-black',
                        'secondary' => 'bg-neutral-800 dark:bg-neutral-300 text-neutral-800 dark:text-neutral-300',
                        'success' => 'bg-green-500 dark:bg-undefined text-white dark:text-black',
                        'info' => 'bg-sky-500 dark:bg-undefined text-white dark:text-black',
                        'warning' => 'bg-amber-500 dark:bg-undefined text-white dark:text-black',
                        'danger' => 'bg-red-500 dark:bg-undefined text-white dark:text-black',
                    ],
                ],
                'defaultVariants' => [
                    'color' => 'primary',
                ],
            ],
        );
    }
}
