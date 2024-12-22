<?php

namespace RealZone22\PenguBlade\Services\PenguBlade;

use FeatureNinja\Cva\ClassVarianceAuthority;

class BadgeCvaService
{
    public static function new(): ClassVarianceAuthority
    {
        return ClassVarianceAuthority::new(
            ['rounded-md w-fit px-2 py-1 text-xs font-medium'],
            [
                'variants' => [
                    'color' => [
                        'default' => 'bg-neutral-50 text-neutral-600 dark:bg-neutral-900 dark:text-neutral-300',
                        'inverse' => 'bg-neutral-900 text-neutral-300 dark:bg-neutral-50 dark:text-neutral-600',
                        'primary' => 'bg-black text-neutral-100 dark:bg-white dark:text-neutral-100',
                        'secondary' => 'bg-neutral-800 text-white dark:bg-neutral-300 dark:text-black',
                        'info' => 'bg-sky-500 text-white dark:bg-sky-500 dark:text-white',
                        'success' => 'bg-green-500 text-white dark:bg-green-500 dark:text-white',
                        'warning' => 'bg-amber-500 text-white dark:bg-amber-500 dark:text-white',
                        'error' => 'bg-red-500 text-white dark:bg-red-500 dark:text-white',
                    ],
                ],
                'defaultVariants' => [
                    'color' => 'default',
                ],
            ],
        );
    }
}
