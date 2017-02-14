<?php

namespace TypiCMS\Modules\Slideshows\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Slideshows\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('slideshows')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.slideshows', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.slideshows.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/slideshows', ['as' => 'admin.slideshows.index', 'uses' => 'AdminController@index']);
            $router->get('admin/slideshows/create', ['as' => 'admin.slideshows.create', 'uses' => 'AdminController@create']);
            $router->get('admin/slideshows/{slideshow}/edit', ['as' => 'admin.slideshows.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/slideshows', ['as' => 'admin.slideshows.store', 'uses' => 'AdminController@store']);
            $router->put('admin/slideshows/{slideshow}', ['as' => 'admin.slideshows.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/slideshows', ['as' => 'api.slideshows.index', 'uses' => 'ApiController@index']);
            $router->put('api/slideshows/{slideshow}', ['as' => 'api.slideshows.update', 'uses' => 'ApiController@update']);
            $router->delete('api/slideshows/{slideshow}', ['as' => 'api.slideshows.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
