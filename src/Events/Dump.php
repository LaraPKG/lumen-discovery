<?php

declare(strict_types=1);

namespace LaraPkg\LumenDiscover\Events;

use RonAppleton\Discover\Events\Dump as BaseDump;

class Dump extends BaseDump
{
    /**
     * @var array|string[]
     */
    public static array $discoverPaths = [
        'laravel',
        'lumen',
    ];
}
