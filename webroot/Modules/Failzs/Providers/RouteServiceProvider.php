<?php

namespace TypiCMS\Modules\Failzs\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Failzs\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('failzs')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.failzs', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.failzs.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/failzs', ['as' => 'admin.failzs.index', 'uses' => 'AdminController@index']);
            $router->get('admin/failzs/create', ['as' => 'admin.failzs.create', 'uses' => 'AdminController@create']);
            $router->get('admin/failzs/{failz}/edit', ['as' => 'admin.failzs.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/failzs', ['as' => 'admin.failzs.store', 'uses' => 'AdminController@store']);
            $router->put('admin/failzs/{failz}', ['as' => 'admin.failzs.update', 'uses' => 'AdminController@update']);

            $router->post('admin/failzs/giphy', ['as' => 'admin.failzs.giphy', 'uses' => 'AdminController@giphy']);
            $router->post('admin/failzs/settings', ['as' => 'admin.failzs.settings', 'uses' => 'AdminController@settings']);
            $router->get('admin/failzs/status/{status}', ['as' => 'admin.failzs.status', 'uses' => 'AdminController@changeGiphyStatus']);

            /*
             * API routes
             */
            $router->get('api/failzs', ['as' => 'api.failzs.index', 'uses' => 'ApiController@index']);
            $router->put('api/failzs/{failz}', ['as' => 'api.failzs.update', 'uses' => 'ApiController@update']);
            $router->delete('api/failzs/{failz}', ['as' => 'api.failzs.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
