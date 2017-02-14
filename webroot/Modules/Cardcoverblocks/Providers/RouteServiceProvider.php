<?php

namespace TypiCMS\Modules\Cardcoverblocks\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Cardcoverblocks\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('cardcoverblocks')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.cardcoverblocks', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.cardcoverblocks.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/cardcoverblocks', ['as' => 'admin.cardcoverblocks.index', 'uses' => 'AdminController@index']);
            $router->get('admin/cardcoverblocks/create', ['as' => 'admin.cardcoverblocks.create', 'uses' => 'AdminController@create']);
            $router->get('admin/cardcoverblocks/{cardcoverblock}/edit', ['as' => 'admin.cardcoverblocks.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/cardcoverblocks', ['as' => 'admin.cardcoverblocks.store', 'uses' => 'AdminController@store']);
            $router->put('admin/cardcoverblocks/{cardcoverblock}', ['as' => 'admin.cardcoverblocks.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/cardcoverblocks', ['as' => 'api.cardcoverblocks.index', 'uses' => 'ApiController@index']);
            $router->put('api/cardcoverblocks/{cardcoverblock}', ['as' => 'api.cardcoverblocks.update', 'uses' => 'ApiController@update']);
            $router->delete('api/cardcoverblocks/{cardcoverblock}', ['as' => 'api.cardcoverblocks.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
