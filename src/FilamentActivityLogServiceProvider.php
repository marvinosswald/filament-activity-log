<?php

namespace Marvinosswald\FilamentActivityLog;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentActivityLogServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-activity-log';

    public static string $viewNamespace = 'filament-activity-log';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasViews();
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            Css::make('filament-activity-log', __DIR__ . '/../resources/dist/filament-activity-log.css')->loadedOnRequest(),
        ], 'marvinosswald/filament-activity-log');
    }
}
