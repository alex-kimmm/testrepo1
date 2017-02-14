<?php

namespace TypiCMS\Modules\Pagefailzs\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Pagefailzs\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('pagefailzs')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.pagefailzs', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.pagefailzs.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/pagefailzs', ['as' => 'admin.pagefailzs.index', 'uses' => 'AdminController@index']);
            $router->get('admin/pagefailzs/create', ['as' => 'admin.pagefailzs.create', 'uses' => 'AdminController@create']);
            $router->get('admin/pagefailzs/{pagefailz}/edit', ['as' => 'admin.pagefailzs.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/pagefailzs', ['as' => 'admin.pagefailzs.store', 'uses' => 'AdminController@store']);
            $router->put('admin/pagefailzs/{pagefailz}', ['as' => 'admin.pagefailzs.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/pagefailzs', ['as' => 'api.pagefailzs.index', 'uses' => 'ApiController@index']);
            $router->put('api/pagefailzs/{pagefailz}', ['as' => 'api.pagefailzs.update', 'uses' => 'ApiController@update']);
            $router->delete('api/pagefailzs/{pagefailz}', ['as' => 'api.pagefailzs.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
