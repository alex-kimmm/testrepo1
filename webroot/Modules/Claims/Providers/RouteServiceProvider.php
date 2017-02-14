<?php

namespace TypiCMS\Modules\Claims\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Claims\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('claims')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.claims', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.claims.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/claims', ['as' => 'admin.claims.index', 'uses' => 'AdminController@index']);
            $router->get('admin/claims/create', ['as' => 'admin.claims.create', 'uses' => 'AdminController@create']);
            $router->get('admin/claims/{claim}/edit', ['as' => 'admin.claims.edit', 'uses' => 'AdminController@edit']);
            $router->get('admin/claims/{claim}/view', ['as' => 'admin.claims.view', 'uses' => 'AdminController@view']);
            $router->post('admin/claims', ['as' => 'admin.claims.store', 'uses' => 'AdminController@store']);
            $router->put('admin/claims/{claim}', ['as' => 'admin.claims.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/claims', ['as' => 'api.claims.index', 'uses' => 'ApiController@index']);
            $router->put('api/claims/{claim}', ['as' => 'api.claims.update', 'uses' => 'ApiController@update']);
            $router->delete('api/claims/{claim}', ['as' => 'api.claims.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
