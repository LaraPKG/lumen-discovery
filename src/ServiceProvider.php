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

        foreach ($cache->get('providers') as $provider) {
            $this->app->register($provider);
        }

        foreach ($cache->get('aliases') as $key => $alias) {
            $this->app->alias($key, $alias);
        }
    }
}
