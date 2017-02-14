<?php

namespace TypiCMS\Modules\Homepageblocks\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Homepageblocks\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('homepageblocks')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.homepageblocks', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.homepageblocks.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/homepageblocks', ['as' => 'admin.homepageblocks.index', 'uses' => 'AdminController@index']);
            $router->get('admin/homepageblocks/create', ['as' => 'admin.homepageblocks.create', 'uses' => 'AdminController@create']);
            $router->get('admin/homepageblocks/{homepageblock}/edit', ['as' => 'admin.homepageblocks.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/homepageblocks', ['as' => 'admin.homepageblocks.store', 'uses' => 'AdminController@store']);
            $router->put('admin/homepageblocks/{homepageblock}', ['as' => 'admin.homepageblocks.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/homepageblocks', ['as' => 'api.homepageblocks.index', 'uses' => 'ApiController@index']);
            $router->put('api/homepageblocks/{homepageblock}', ['as' => 'api.homepageblocks.update', 'uses' => 'ApiController@update']);
            $router->delete('api/homepageblocks/{homepageblock}', ['as' => 'api.homepageblocks.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
