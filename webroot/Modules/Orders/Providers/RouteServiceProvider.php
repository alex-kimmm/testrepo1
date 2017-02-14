<?php

namespace TypiCMS\Modules\Orders\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Orders\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('orders')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.orders', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.orders.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/orders', ['as' => 'admin.orders.index', 'uses' => 'AdminController@index']);
            $router->post('admin/orders/csv', ['as' => 'admin.orders.csv', 'uses' => 'AdminController@csv']);
            $router->get('admin/orders/create', ['as' => 'admin.orders.create', 'uses' => 'AdminController@create']);
            $router->get('admin/orders/{order}/edit', ['as' => 'admin.orders.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/orders', ['as' => 'admin.orders.store', 'uses' => 'AdminController@store']);
            $router->put('admin/orders/{order}', ['as' => 'admin.orders.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/orders', ['as' => 'api.orders.index', 'uses' => 'ApiController@index']);
            $router->put('api/orders/{order}', ['as' => 'api.orders.update', 'uses' => 'ApiController@update']);
            $router->delete('api/orders/{order}', ['as' => 'api.orders.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
