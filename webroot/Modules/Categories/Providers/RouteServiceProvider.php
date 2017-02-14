<?php

namespace TypiCMS\Modules\Categories\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Categories\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('categories')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.categories', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.categories.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/categories', ['as' => 'admin.categories.index', 'uses' => 'AdminController@index']);
            $router->get('admin/categories/create', ['as' => 'admin.categories.create', 'uses' => 'AdminController@create']);
            $router->get('admin/categories/{category}/edit', ['as' => 'admin.categories.edit', 'uses' => 'AdminController@edit']);
            // $router->get('admin/categories/{category}/delete', ['as' => 'admin.categories.delete', 'uses' => 'AdminController@delete']);
            $router->post('admin/categories', ['as' => 'admin.categories.store', 'uses' => 'AdminController@store']);
            $router->put('admin/categories/{category}', ['as' => 'admin.categories.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/categories', ['as' => 'api.categories.index', 'uses' => 'ApiController@index']);
            $router->put('api/categories/{category}', ['as' => 'api.categories.update', 'uses' => 'ApiController@update']);
            $router->delete('api/categories/{category}', ['as' => 'api.categories.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
