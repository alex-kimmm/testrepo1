<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\DB;

class RegisterTest extends TestCase {

    private static $emailToRegister = 'veaceslav.codrean@eltonic.com';
    private static $passwordToRegister = 'pass-secret';

    public function prepareForTests(){
        Config::set('database.default', 'mysql');
        Artisan::call('migrate');
    }

    public function setUp(){
        parent::setUp();

        $this->prepareForTests();
    }

    public function findUserByEmail($email){
        return DB::table('users')->where(['email' => $email])->first();
    }

    public function deleteUserByEmail($email){
        return DB::table('users')->where(['email' => $email])->delete();
    }

    public function testRegistration() {
        print_r("\n\n//=============== Registration");

        // delete if exist user
        $this->deleteUserByEmail(self::$emailToRegister);

        $this->visit(self::AUTH_REGISTER)
            ->type('1', 'usertitle_id')
            ->type(self::$emailToRegister, 'email')
            ->type('Codrean', 'first_name')
            ->type('Veaceslav', 'last_name')
            ->type(self::$passwordToRegister, 'password')
            ->type(self::$passwordToRegister, 'password_confirmation')
            ->press('Register')

            ->seePageIs(self::AUTH_REGISTER)
            ->see('Your account has been created, check your email for the confirmation link.');

        // verify if exist in DB
        $this->seeInDatabase('users', ['email' => self::$emailToRegister]);

        print_r("\n//============================== Account was created");
    }

    public function testActivateAccount() {
        print_r("\n\n//=============== Activate account (confirm link)");

        $this->seeInDatabase('users', ['email' => self::$emailToRegister]);

        $userRegistered = $this->findUserByEmail(self::$emailToRegister);
        $this->visit(self::AUTH_ACTIVATE . self::SEPARATOR . $userRegistered->token)
            ->seePageIs(self::AUTH_LOGIN)

            ->see('Your account has been activated, you can now log in.');

        print_r("\n//============================== Account was activated");
    }
}
