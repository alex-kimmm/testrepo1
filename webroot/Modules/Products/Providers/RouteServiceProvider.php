<?php

namespace TypiCMS\Modules\Products\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Products\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('products')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.products', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.products.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/products', ['as' => 'admin.products.index', 'uses' => 'AdminController@index']);
            $router->get('admin/products/create', ['as' => 'admin.products.create', 'uses' => 'AdminController@create']);
            $router->get('admin/products/{product}/edit', ['as' => 'admin.products.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/products', ['as' => 'admin.products.store', 'uses' => 'AdminController@store']);
            $router->put('admin/products/{product}', ['as' => 'admin.products.update', 'uses' => 'AdminController@update']);

            $router->post('admin/products/insurances', ['as' => 'admin.products.insurances', 'uses' => 'AdminController@insurances']);

            /*
             * API routes
             */
            $router->get('api/products', ['as' => 'api.products.index', 'uses' => 'ApiController@index']);
            $router->put('api/products/{product}', ['as' => 'api.products.update', 'uses' => 'ApiController@update']);
            $router->delete('api/products/{product}', ['as' => 'api.products.destroy', 'uses' => 'ApiController@destroy']);
            $router->post('api/products/image/{product}', ['as' => 'api.products.image.upload', 'uses' => 'ApiController@upload']);
            $router->get('api/products/image/delete/{id}', ['as' => 'api.products.image.delete', 'uses' => 'ApiController@removeImage']);
        });
    }
}
