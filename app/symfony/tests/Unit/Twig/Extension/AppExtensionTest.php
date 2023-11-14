<?php

namespace App\Tests\Twig\Extension;

use PHPUnit\Framework\TestCase;
use App\Twig\Extension\AppExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtensionTest extends TestCase
{
    private AppExtension $extension;

    protected function setUp(): void
    {
        $this->extension = new AppExtension();
    }

    public function testGetFilters()
    {
        $filters = $this->extension->getFilters();
        $this->assertCount(1, $filters);
        $this->assertInstanceOf(TwigFilter::class, $filters[0]);
        $this->assertEquals('app_filter_name', $filters[0]->getName());
    }

    public function testGetFunctions()
    {
        $functions = $this->extension->getFunctions();
        $this->assertCount(1, $functions);
        $this->assertInstanceOf(TwigFunction::class, $functions[0]);
        $this->assertEquals('app_function_name', $functions[0]->getName());
    }
}
