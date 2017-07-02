<?php namespace Defr\TestingTheme;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class TestingThemeServiceProvider extends AddonServiceProvider
{

    protected $plugins = [];

    protected $commands = [];

    protected $schedules = [];

    protected $api = [];

    protected $routes = [];

    protected $middleware = [];

    protected $routeMiddleware = [];

    protected $listeners = [];

    protected $aliases = [];

    protected $bindings = [];

    protected $providers = [];

    protected $singletons = [];

    protected $overrides = [];

    protected $mobile = [];

    public function register()
    {
    }

    public function map()
    {
    }

}
