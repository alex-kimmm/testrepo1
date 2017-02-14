<?php

namespace TypiCMS\Modules\Insuranceblocks\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Insuranceblocks\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('insuranceblocks')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.insuranceblocks', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.insuranceblocks.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/insuranceblocks', ['as' => 'admin.insuranceblocks.index', 'uses' => 'AdminController@index']);
            $router->get('admin/insuranceblocks/create', ['as' => 'admin.insuranceblocks.create', 'uses' => 'AdminController@create']);
            $router->get('admin/insuranceblocks/{insuranceblock}/edit', ['as' => 'admin.insuranceblocks.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/insuranceblocks', ['as' => 'admin.insuranceblocks.store', 'uses' => 'AdminController@store']);
            $router->put('admin/insuranceblocks/{insuranceblock}', ['as' => 'admin.insuranceblocks.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/insuranceblocks', ['as' => 'api.insuranceblocks.index', 'uses' => 'ApiController@index']);
            $router->put('api/insuranceblocks/{insuranceblock}', ['as' => 'api.insuranceblocks.update', 'uses' => 'ApiController@update']);
            $router->delete('api/insuranceblocks/{insuranceblock}', ['as' => 'api.insuranceblocks.destroy', 'uses' => 'ApiController@destroy']);

            $router->get('api/insuranceblocks/file/delete/{id}', ['as' => 'api.insuranceblocks.file.delete', 'uses' => 'ApiController@removeFile']);
        });
    }
}
