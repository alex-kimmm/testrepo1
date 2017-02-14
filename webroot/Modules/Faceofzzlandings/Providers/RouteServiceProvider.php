<?php

namespace TypiCMS\Modules\Faceofzzlandings\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Faceofzzlandings\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('faceofzzlandings')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.faceofzzlandings', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.faceofzzlandings.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/faceofzzlandings', ['as' => 'admin.faceofzzlandings.index', 'uses' => 'AdminController@index']);
            $router->get('admin/faceofzzlandings/create', ['as' => 'admin.faceofzzlandings.create', 'uses' => 'AdminController@create']);
            $router->get('admin/faceofzzlandings/{faceofzzlanding}/edit', ['as' => 'admin.faceofzzlandings.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/faceofzzlandings', ['as' => 'admin.faceofzzlandings.store', 'uses' => 'AdminController@store']);
            $router->put('admin/faceofzzlandings/{faceofzzlanding}', ['as' => 'admin.faceofzzlandings.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/faceofzzlandings', ['as' => 'api.faceofzzlandings.index', 'uses' => 'ApiController@index']);
            $router->put('api/faceofzzlandings/{faceofzzlanding}', ['as' => 'api.faceofzzlandings.update', 'uses' => 'ApiController@update']);
            $router->delete('api/faceofzzlandings/{faceofzzlanding}', ['as' => 'api.faceofzzlandings.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
