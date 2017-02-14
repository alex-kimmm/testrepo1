<?php

class LoginTest extends TestCase {

    private static $emailToLogin = 'admin@admin.com';
    private static $passwordToLogin = '11111111';

    public function testLogin() {
        print_r("\n\n//=============== Login");

        $this->visit(self::AUTH_LOGIN)
            ->type(self::$emailToLogin, 'email')
            ->type(self::$passwordToLogin, 'password')
            ->press('Log in')
            ->seePageIs('/')

            ->visit(self::ADMIN_DASHBOARD)
            ->see(self::$emailToLogin);   // in dashboard menu exist user email

        print_r("\n//============================== Login successful");
    }

}
