<?php namespace Web812\AlexmebelTheme;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class AlexmebelThemeServiceProvider extends AddonServiceProvider
{

    /**
     * Addon views overrides
     *
     * @var array
     */
    protected $overrides = [
        'anomaly.module.posts::posts.index' => 'web812.theme.alexmebel::posts.index',
    ];

    /**
     * Addon routes
     *
     * @var array
     */
    protected $routes = [
        'request' => 'Web812\AlexmebelTheme\Http\Controller\FormController@userRequest',
    ];
}
