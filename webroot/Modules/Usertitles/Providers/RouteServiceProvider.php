<?php

namespace TypiCMS\Modules\Usertitles\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use TypiCMS\Modules\Core\Facades\TypiCMS;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'TypiCMS\Modules\Usertitles\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {

            /*
             * Front office routes
             */
            if ($page = TypiCMS::getPageLinkedToModule('usertitles')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.usertitles', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.usertitles.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/usertitles', ['as' => 'admin.usertitles.index', 'uses' => 'AdminController@index']);
            $router->get('admin/usertitles/create', ['as' => 'admin.usertitles.create', 'uses' => 'AdminController@create']);
            $router->get('admin/usertitles/{usertitle}/edit', ['as' => 'admin.usertitles.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/usertitles', ['as' => 'admin.usertitles.store', 'uses' => 'AdminController@store']);
            $router->put('admin/usertitles/{usertitle}', ['as' => 'admin.usertitles.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/usertitles', ['as' => 'api.usertitles.index', 'uses' => 'ApiController@index']);
            $router->put('api/usertitles/{usertitle}', ['as' => 'api.usertitles.update', 'uses' => 'ApiController@update']);
            $router->delete('api/usertitles/{usertitle}', ['as' => 'api.usertitles.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
