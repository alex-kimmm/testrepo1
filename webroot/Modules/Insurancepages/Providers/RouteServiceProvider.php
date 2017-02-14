<?php

namespace TypiCMS\Modules\Insurancepages\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Insurancepages\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('insurancepages')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.insurancepages', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.insurancepages.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/insurancepages', ['as' => 'admin.insurancepages.index', 'uses' => 'AdminController@index']);
            $router->get('admin/insurancepages/create', ['as' => 'admin.insurancepages.create', 'uses' => 'AdminController@create']);
            $router->get('admin/insurancepages/{insurancepage}/edit', ['as' => 'admin.insurancepages.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/insurancepages', ['as' => 'admin.insurancepages.store', 'uses' => 'AdminController@store']);
            $router->put('admin/insurancepages/{insurancepage}', ['as' => 'admin.insurancepages.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/insurancepages', ['as' => 'api.insurancepages.index', 'uses' => 'ApiController@index']);
            $router->put('api/insurancepages/{insurancepage}', ['as' => 'api.insurancepages.update', 'uses' => 'ApiController@update']);
            $router->delete('api/insurancepages/{insurancepage}', ['as' => 'api.insurancepages.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
