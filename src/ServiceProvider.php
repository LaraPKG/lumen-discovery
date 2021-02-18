<?php

declare(strict_types=1);

namespace LaraPkg\LumenDiscover;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use RonAppleton\Discover\Helpers\PackageLoader;

/**
 * Class ServiceProvider
 * @package LaraPkg\LumenDiscover
 * @author Ron Appleton <ron@appleton.digital>
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function register()
    {
        $cache = $this->app->make(PackageLoader::class);

        foreach ($cache->get() as $package) {
            if (!empty($package['providers'])) {
                array_walk($package['providers'], function ($provider) {
                    $this->app->register($provider);
                });
            }

            if (!empty($package['aliases'])) {
                array_walk($package['aliases'], function ($alias, $class) {
                    $this->app->alias($alias, $class);
                });
            }
        }
    }
}
