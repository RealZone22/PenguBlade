<?php

namespace RealZone22\PenguBlade;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PenguBladeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('pengublade')
            ->hasConfigFile()
            ->hasViews('pengublade');

        $this->registerComponents();
    }

    public function registerComponents()
    {
        $this->publishes([
            __DIR__.'/../resources/views/components' => resource_path('views/components'),
            __DIR__.'/../src/Services' => app_path('Services'),
            //     __DIR__.'/../resources/views/livewire' => resource_path('views/vendor/pengublade/livewire'),
            //     __DIR__.'/../src/Livewire' => app_path('Livewire'),
        ], 'pengublade-components');

        $dirs = array_filter(glob(__DIR__.'/../resources/views/components/*'), 'is_dir');
        foreach ($dirs as $dir) {
            $this->publishes([
                $dir => resource_path('views/components/'.basename($dir)),
            ], 'pengublade-components-'.basename($dir));
        }
    }
}
