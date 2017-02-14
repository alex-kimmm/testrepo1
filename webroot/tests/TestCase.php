<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    // Routes
    const SEPARATOR = '/';

    // login
    const AUTH_LOGIN = '/auth/login';

    // register
    const AUTH_REGISTER = '/auth/register';
    const AUTH_ACTIVATE = '/auth/activate';

    // admin
    const ADMIN = '/admin';
    const ADMIN_DASHBOARD = '/admin/dashboard';

    // colors
    const COLORS = '/admin/colors';
    const COLORS_CREATE = '/admin/colors/create';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
}
