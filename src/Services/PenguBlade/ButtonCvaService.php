<?php

namespace RealZone22\PenguBlade\Services\PenguBlade;

use FeatureNinja\Cva\ClassVarianceAuthority;

class ButtonCvaService
{
    public static function new(): ClassVarianceAuthority
    {
        return ClassVarianceAuthority::new(
            [
                'cursor-pointer whitespace-nowrap rounded-md px-4 py-2 gap-2 text-sm font-medium tracking-wide transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed',
            ],
            [
                'variants' => [
                    'solid' => [
                        'primary' => 'bg-black text-neutral-100 dark:bg-white dark:text-black dark:focus-visible:outline-white focus-visible:outline-black',
                        'secondary' => 'bg-neutral-800 text-white focus-visible:outline-neutral-800 dark:bg-neutral-300 dark:text-black dark:focus-visible:outline-neutral-300',
                        'alternate' => 'bg-neutral-50 text-neutral-900 focus-visible:outline-neutral-50 dark:bg-neutral-900 dark:text-white dark:focus-visible:outline-neutral-900',
                        'inverse' => 'bg-neutral-950 text-neutral-300 focus-visible:outline-neutral-950 dark:bg-white dark:text-neutral-600 dark:focus-visible:outline-white',
                        'info' => 'bg-sky-500 text-white focus-visible:outline-sky-500 dark:bg-sky-500 dark:text-white dark:focus-visible:outline-sky-500',
                        'danger' => 'bg-red-500 text-white focus-visible:outline-red-500 dark:bg-red-500 dark:text-white dark:focus-visible:outline-red-500',
                        'warning' => 'bg-amber-500 text-white focus-visible:outline-amber-500 dark:bg-amber-500 dark:text-white dark:focus-visible:outline-amber-500',
                        'success' => 'bg-green-500 text-white focus-visible:outline-green-500 dark:bg-green-500 dark:text-white dark:focus-visible:outline-green-500',
                    ],
                    'outline' => [
                        'primary' => 'border border-black text-black focus-visible:outline-black dark:border-white dark:text-white dark:focus-visible:outline-white',
                        'secondary' => 'border border-neutral-800 text-neutral-800 focus-visible:outline-neutral-800 dark:border-neutral-300 dark:text-neutral-300 dark:focus-visible:outline-neutral-300',
                        'alternate' => 'border border-neutral-300 text-neutral-300 focus-visible:outline-neutral-300 dark:border-neutral-700 dark:text-neutral-700 dark:focus-visible:outline-neutral-700',
                        'inverse' => 'border border-neutral-950 text-neutral-950 focus-visible:outline-neutral-950 dark:border-white dark:text-white dark:focus-visible:outline-white',
                        'info' => 'border border-sky-500 text-sky-500 focus-visible:outline-sky-500 dark:border-sky-500 dark:text-sky-500 dark:focus-visible:outline-sky-500',
                        'danger' => 'border border-red-500 text-red-500 focus-visible:outline-red-500 dark:border-red-500 dark:text-red-500 dark:focus-visible:outline-red-500',
                        'warning' => 'border border-amber-500 text-amber-500 focus-visible:outline-amber-500 dark:border-amber-500 dark:text-amber-500 dark:focus-visible:outline-amber-500',
                        'success' => 'border border-green-500 text-green-500 focus-visible:outline-green-500 dark:border-green-500 dark:text-green-500 dark:focus-visible:outline-green-500',
                    ],
                    'ghost' => [
                        'primary' => 'text-black focus-visible:outline-black dark:text-white dark:focus-visible:outline-white',
                        'secondary' => 'text-neutral-800 focus-visible:outline-neutral-800 dark:text-neutral-300 dark:focus-visible:outline-neutral-300',
                        'alternate' => 'text-neutral-300 focus-visible:outline-neutral-300 dark:text-neutral-700 dark:focus-visible:outline-neutral-700',
                        'inverse' => 'text-neutral-950 focus-visible:outline-neutral-950 dark:text-white dark:focus-visible:outline-white',
                        'info' => 'text-sky-500 focus-visible:outline-sky-500 dark:text-sky-500 dark:focus-visible:outline-sky-500',
                        'danger' => 'text-red-500 focus-visible:outline-red-500 dark:text-red-500 dark:focus-visible:outline-red-500',
                        'warning' => 'text-amber-500 focus-visible:outline-amber-500 dark:text-amber-500 dark:focus-visible:outline-amber-500',
                        'success' => 'text-green-500 focus-visible:outline-green-500 dark:text-green-500 dark:focus-visible:outline-green-500',
                    ],
                ],
                'defaultVariants' => [
                    'variant' => 'solid',
                    'color' => 'primary',
                ],
            ],
        );
    }
}
