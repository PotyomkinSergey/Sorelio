<?php
declare(strict_types=1);
namespace App\Providers;

use App\services\custom\CustomInterface;
use App\services\custom\SomeClass;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class OtherServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $bindings = [
        CustomInterface::class => SomeClass::class,
    ];
}
