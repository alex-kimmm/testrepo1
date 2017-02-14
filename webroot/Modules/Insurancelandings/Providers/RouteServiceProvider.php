<?php

namespace TypiCMS\Modules\Insurancelandings\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Insurancelandings\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('insurancelandings')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.insurancelandings', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.insurancelandings.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/insurancelandings', ['as' => 'admin.insurancelandings.index', 'uses' => 'AdminController@index']);
            $router->get('admin/insurancelandings/create', ['as' => 'admin.insurancelandings.create', 'uses' => 'AdminController@create']);
            $router->get('admin/insurancelandings/{insurancelanding}/edit', ['as' => 'admin.insurancelandings.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/insurancelandings', ['as' => 'admin.insurancelandings.store', 'uses' => 'AdminController@store']);
            $router->put('admin/insurancelandings/{insurancelanding}', ['as' => 'admin.insurancelandings.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/insurancelandings', ['as' => 'api.insurancelandings.index', 'uses' => 'ApiController@index']);
            $router->put('api/insurancelandings/{insurancelanding}', ['as' => 'api.insurancelandings.update', 'uses' => 'ApiController@update']);
            $router->delete('api/insurancelandings/{insurancelanding}', ['as' => 'api.insurancelandings.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
