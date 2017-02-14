<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Support\Facades\DB;

class CRUDColorTest extends TestCase {

    private static $emailToLogin = 'admin@admin.com';
    private static $passwordToLogin = '11111111';

    public function findOneColorBy($fieldName, $value){
        return DB::table('colors')->where([$fieldName => $value])->first();
    }

    public function findOneColorByTitleAndColorCode($title, $colorCode){
        return
            DB::table('colors')
                ->join('color_translations', 'colors.id', '=', 'color_translations.color_id')
                ->select('colors.*')
                ->where(['color_translations.title' => $title, 'colors.color_code' => $colorCode])
                ->first();
    }

    public function deleteColorByTitleAndColorCode($title, $colorCode){
        return
            DB::table('colors')
                ->join('color_translations', 'colors.id', '=', 'color_translations.color_id')
                ->select('colors.*')
                ->where(['color_translations.title' => $title, 'colors.color_code' => $colorCode])
                ->delete();
    }

    public function login() {
        print_r("\n\n//=============== Login");

        $this->visit(self::AUTH_LOGIN)
            ->type(self::$emailToLogin, 'email')
            ->type(self::$passwordToLogin, 'password')
            ->press('Log in')
            ->seePageIs('/')

            ->visit(self::ADMIN_DASHBOARD)
            ->see(self::$emailToLogin);

        print_r("\n//============================== Login successful");
    }

    public function testCreate() {
        print_r("\n\n//=============== Create Color");

        $this->login();

        $titleColor = 'Created new test color';
        $colorInHexa = '008000'; // green

        // delete if exist this color
        $this->deleteColorByTitleAndColorCode($titleColor, $colorInHexa);

        $this->visit(self::COLORS_CREATE)
             ->type($titleColor, 'en[title]')
             ->type('green', 'en[slug]')
             ->type($colorInHexa, 'color_code')
             ->check('en[status]')
             ->press('Save')
             ->see($titleColor)

             ->visit(self::COLORS)
             ->see($titleColor);

        print_r("\n//============================== New color was created");
    }

    public function testDisableColor() {
        print_r("\n\n//=============== Disable color");

        $this->login();

        $titleColor = 'Created new test color';
        $colorInHexa = '008000';
        $colorToDisable = $this->findOneColorByTitleAndColorCode($titleColor, $colorInHexa);

        $colorEditLink = self::COLORS . '/' . $colorToDisable->id . '/edit';
        $this->visit($colorEditLink)
            ->check('en[status]')
            ->press('Save and exit')

            ->see($colorInHexa);

        print_r("\n//============================== Color was set disable");
    }

    public function testEditColor(){
        print_r("\n\n//=============== Edit Color");

        $this->login();

        $titleColor = 'Created new test color';
        $colorInHexa = '008000';
        $colorInHexaToEdit = '800000';

        $colorToDisable = $this->findOneColorByTitleAndColorCode($titleColor, $colorInHexa);
        $colorEditLink = self::COLORS . '/' . $colorToDisable->id . '/edit';

        $this->visit($colorEditLink)
            ->type($colorInHexaToEdit, 'color_code')
            ->press('Save and exit')

            ->see($colorInHexaToEdit); // redirected to colors page and view color updated

        print_r("\n//============================== Color was updated");
    }

}
