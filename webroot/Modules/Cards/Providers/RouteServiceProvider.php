<?php

namespace TypiCMS\Modules\Cards\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Cards\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('cards')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.cards', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.cards.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/cards', ['as' => 'admin.cards.index', 'uses' => 'AdminController@index']);
            $router->get('admin/cards/create', ['as' => 'admin.cards.create', 'uses' => 'AdminController@create']);
            $router->get('admin/cards/{card}/edit', ['as' => 'admin.cards.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/cards', ['as' => 'admin.cards.store', 'uses' => 'AdminController@store']);
            $router->put('admin/cards/{card}', ['as' => 'admin.cards.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/cards', ['as' => 'api.cards.index', 'uses' => 'ApiController@index']);
            $router->put('api/cards/{card}', ['as' => 'api.cards.update', 'uses' => 'ApiController@update']);
            $router->delete('api/cards/{card}', ['as' => 'api.cards.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
