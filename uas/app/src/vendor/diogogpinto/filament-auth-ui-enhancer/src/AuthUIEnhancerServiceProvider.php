<?php

namespace DiogoGPinto\AuthUIEnhancer;

use DiogoGPinto\AuthUIEnhancer\Testing\TestsAuthUIEnhancer;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AuthUIEnhancerServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-auth-ui-enhancer';

    public static string $viewNamespace = 'filament-auth-ui-enhancer';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasViews(static::$viewNamespace);
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        // Testing
        Testable::mixin(new TestsAuthUIEnhancer);
    }
}
