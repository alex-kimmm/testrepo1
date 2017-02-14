<?php

namespace TypiCMS\Modules\Slideshowitems\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Slideshowitems\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('slideshowitems')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.slideshowitems', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.slideshowitems.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/slideshowitems', ['as' => 'admin.slideshowitems.index', 'uses' => 'AdminController@index']);
            $router->get('admin/slideshowitems/create', ['as' => 'admin.slideshowitems.create', 'uses' => 'AdminController@create']);
            $router->get('admin/slideshowitems/{slideshowitem}/edit', ['as' => 'admin.slideshowitems.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/slideshowitems', ['as' => 'admin.slideshowitems.store', 'uses' => 'AdminController@store']);
            $router->put('admin/slideshowitems/{slideshowitem}', ['as' => 'admin.slideshowitems.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/slideshowitems', ['as' => 'api.slideshowitems.index', 'uses' => 'ApiController@index']);
            $router->put('api/slideshowitems/{slideshowitem}', ['as' => 'api.slideshowitems.update', 'uses' => 'ApiController@update']);
            $router->delete('api/slideshowitems/{slideshowitem}', ['as' => 'api.slideshowitems.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
