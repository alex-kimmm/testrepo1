<?php

namespace TypiCMS\Modules\Musiccards\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Musiccards\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('musiccards')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.musiccards', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.musiccards.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/musiccards', ['as' => 'admin.musiccards.index', 'uses' => 'AdminController@index']);
            $router->get('admin/musiccards/create', ['as' => 'admin.musiccards.create', 'uses' => 'AdminController@create']);
            $router->get('admin/musiccards/{musiccard}/edit', ['as' => 'admin.musiccards.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/musiccards', ['as' => 'admin.musiccards.store', 'uses' => 'AdminController@store']);
            $router->put('admin/musiccards/{musiccard}', ['as' => 'admin.musiccards.update', 'uses' => 'AdminController@update']);
            $router->post('admin/musiccards/sort', ['as' => 'admin.musiccards.sort', 'uses' => 'AdminController@sort']);

            /*
             * API routes
             */
            $router->get('api/musiccards', ['as' => 'api.musiccards.index', 'uses' => 'ApiController@index']);
            $router->put('api/musiccards/{musiccard}', ['as' => 'api.musiccards.update', 'uses' => 'ApiController@update']);
            $router->delete('api/musiccards/{musiccard}', ['as' => 'api.musiccards.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
