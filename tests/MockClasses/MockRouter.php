<?php


namespace Elegasoft\Mailbox\Tests\MockClasses;


use BeyondCode\Mailbox\Routing\Route;
use BeyondCode\Mailbox\Routing\Router;
use Illuminate\Support\Collection;
use ReflectionClass;

class MockRouter extends Router
{
    public function getMappedRoutes(): Collection
    {
        $reflection = new ReflectionClass($this->routes);
        $property = $reflection->getProperty('routes');
        $property->setAccessible(true);
        return collect($property->getValue($this->routes))->map(function (Route $route)
        {
            return [
                'action'  => $route->action(),
                'pattern' => $route->pattern(),
                'subject' => $route->subject(),
            ];
        });
    }

    public function getFallbackRoute(): Route
    {
        return $this->fallbackRoute;
    }

    public function getCatchAllRoute(): Route
    {
        return $this->catchAllRoute;
    }
}
