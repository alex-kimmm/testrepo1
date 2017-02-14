<?php

namespace TypiCMS\Modules\Quotes\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Quotes\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('quotes')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.quotes', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.quotes.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/quotes', ['as' => 'admin.quotes.index', 'uses' => 'AdminController@index']);
            $router->get('admin/quotes/create', ['as' => 'admin.quotes.create', 'uses' => 'AdminController@create']);
            $router->get('admin/quotes/{quote}/edit', ['as' => 'admin.quotes.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/quotes', ['as' => 'admin.quotes.store', 'uses' => 'AdminController@store']);
            $router->put('admin/quotes/{quote}', ['as' => 'admin.quotes.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/quotes', ['as' => 'api.quotes.index', 'uses' => 'ApiController@index']);
            $router->put('api/quotes/{quote}', ['as' => 'api.quotes.update', 'uses' => 'ApiController@update']);
            $router->delete('api/quotes/{quote}', ['as' => 'api.quotes.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
