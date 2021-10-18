<?php

declare(strict_types=1);

namespace LaraPkg\LumenDiscover;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

use LaraPkg\LumenDiscover\Events\Dump;
use RonAppleton\Discover\Helpers\Manager;

/**
 * Class ServiceProvider
 *
 * @package LaraPkg\LumenDiscover
 * @author Ron Appleton <ron@gmail.com>
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function register(): void
    {

        $cache = new Manager(Dump::$discoverPaths);

        foreach ($cache->cacheGet() as $package) {
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
