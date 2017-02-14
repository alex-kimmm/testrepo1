<?php

namespace TypiCMS\Modules\Gradients\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Gradients\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('gradients')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.gradients', 'uses' => 'PublicController@index']);
//                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.gradients.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/gradients', ['as' => 'admin.gradients.index', 'uses' => 'AdminController@index']);
            $router->get('admin/gradients/create', ['as' => 'admin.gradients.create', 'uses' => 'AdminController@create']);
            $router->get('admin/gradients/{gradient}/edit', ['as' => 'admin.gradients.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/gradients', ['as' => 'admin.gradients.store', 'uses' => 'AdminController@store']);
            $router->put('admin/gradients/{gradient}', ['as' => 'admin.gradients.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/gradients', ['as' => 'api.gradients.index', 'uses' => 'ApiController@index']);
            $router->put('api/gradients/{gradient}', ['as' => 'api.gradients.update', 'uses' => 'ApiController@update']);
            $router->delete('api/gradients/{gradient}', ['as' => 'api.gradients.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
