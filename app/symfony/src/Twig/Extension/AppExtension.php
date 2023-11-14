<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\AppExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('app_filter_name', [AppExtensionRuntime::class, 'doUcfirst']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('app_function_name', [AppExtensionRuntime::class, 'doUcfirst']),
        ];
    }
}
