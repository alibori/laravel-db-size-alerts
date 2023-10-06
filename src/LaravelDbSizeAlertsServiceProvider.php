<?php

declare(strict_types=1);

namespace Alibori\LaravelDbSizeAlerts;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Alibori\LaravelDbSizeAlerts\Commands\LaravelDbSizeAlertsCommand;

class LaravelDbSizeAlertsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-db-size-alerts')
            ->hasConfigFile()
            ->hasViews()
            ->hasCommand(commandClassName: LaravelDbSizeAlertsCommand::class);
    }
}
