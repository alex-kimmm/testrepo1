<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $typi_menus = [
            ['id' => '1', 'name' => 'main-left', 'class' => 'nav navbar-nav menu', 'created_at' => '2013-09-03 22:05:21', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '2', 'name' => 'main-right', 'class' => 'nav navbar-nav navbar-right', 'created_at' => '2013-09-03 22:05:21', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '3', 'name' => 'footer-insurance', 'class' => '', 'created_at' => '2013-09-03 22:05:21', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '4', 'name' => 'footer-clothing', 'class' => '', 'created_at' => '2013-09-03 22:05:21', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '5', 'name' => 'footer-issues', 'class' => '', 'created_at' => '2013-09-03 22:05:21', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '6', 'name' => 'footer-account', 'class' => '', 'created_at' => '2013-09-03 22:05:21', 'updated_at' => '2014-02-17 16:00:00'],
        ];

        $typi_menu_translations = [
            ['id' => '1', 'menu_id' => '1', 'locale' => 'fr', 'status' => '1', 'title' => 'Main Left', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '2', 'menu_id' => '1', 'locale' => 'nl', 'status' => '1', 'title' => 'Main Left', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '3', 'menu_id' => '1', 'locale' => 'en', 'status' => '1', 'title' => 'Main Left', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],

            ['id' => '4', 'menu_id' => '2', 'locale' => 'fr', 'status' => '1', 'title' => 'Main Right', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '5', 'menu_id' => '2', 'locale' => 'nl', 'status' => '1', 'title' => 'Main Right', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '6', 'menu_id' => '2', 'locale' => 'en', 'status' => '1', 'title' => 'Main Right', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],

            ['id' => '7', 'menu_id' => '3', 'locale' => 'fr', 'status' => '1', 'title' => 'Footer Insurance', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '8', 'menu_id' => '3', 'locale' => 'nl', 'status' => '1', 'title' => 'Footer Insurance', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '9', 'menu_id' => '3', 'locale' => 'en', 'status' => '1', 'title' => 'Footer Insurance', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],

            ['id' => '10', 'menu_id' => '4', 'locale' => 'fr', 'status' => '1', 'title' => 'Footer Clothing', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '11', 'menu_id' => '4', 'locale' => 'nl', 'status' => '1', 'title' => 'Footer Clothing', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '12', 'menu_id' => '4', 'locale' => 'en', 'status' => '1', 'title' => 'Footer Clothing', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],

            ['id' => '13', 'menu_id' => '5', 'locale' => 'fr', 'status' => '1', 'title' => 'Footer Issues', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '14', 'menu_id' => '5', 'locale' => 'nl', 'status' => '1', 'title' => 'Footer Issues', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '15', 'menu_id' => '5', 'locale' => 'en', 'status' => '1', 'title' => 'Footer Issues', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],

            ['id' => '16', 'menu_id' => '6', 'locale' => 'fr', 'status' => '1', 'title' => 'Footer Account', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '17', 'menu_id' => '6', 'locale' => 'nl', 'status' => '1', 'title' => 'Footer Account', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
            ['id' => '18', 'menu_id' => '6', 'locale' => 'en', 'status' => '1', 'title' => 'Footer Account', 'created_at' => '2014-02-17 16:00:00', 'updated_at' => '2014-02-17 16:00:00'],
        ];

        DB::table('menus')->insert($typi_menus);
        DB::table('menu_translations')->insert($typi_menu_translations);
    }
}
