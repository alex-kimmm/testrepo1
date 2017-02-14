<?php

use Illuminate\Database\Seeder;

class MenulinkSeeder extends Seeder
{
    public function run()
    {
        $typi_menulinks = [
            ['id' => '1', 'menu_id' => '1', 'page_id' => null, 'position' => '1', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 22:08:05', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '2', 'menu_id' => '1', 'page_id' => null, 'position' => '2', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '3', 'menu_id' => '1', 'page_id' => null, 'position' => '3', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '4', 'menu_id' => '1', 'page_id' => null, 'position' => '4', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '5', 'menu_id' => '1', 'page_id' => null, 'position' => '5', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '6', 'menu_id' => '1', 'page_id' => null, 'position' => '5', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],

            ['id' => '7', 'menu_id' => '2', 'page_id' => null, 'position' => '1', 'target' => '', 'class' => 'sign-in', 'icon_class' => null, 'has_categories' => 0, 'logged' => 0, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '8', 'menu_id' => '2', 'page_id' => null, 'position' => '2', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 0, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '9', 'menu_id' => '2', 'page_id' => null, 'position' => '3', 'target' => '', 'class' => 'account', 'icon_class' => 'account-icon', 'has_categories' => 0, 'logged' => 1, 'guest' => 0, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '10', 'menu_id' => '2', 'page_id' => null, 'position' => '4', 'target' => '', 'class' => 'basket', 'icon_class' => 'basket-icon', 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],

            ['id' => '11', 'menu_id' => '3', 'page_id' => null, 'position' => '1', 'target' => '', 'class' => 'first', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '12', 'menu_id' => '3', 'page_id' => null, 'position' => '2', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '13', 'menu_id' => '3', 'page_id' => null, 'position' => '3', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],

            ['id' => '14', 'menu_id' => '4', 'page_id' => null, 'position' => '1', 'target' => '', 'class' => 'first', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '15', 'menu_id' => '4', 'page_id' => null, 'position' => '2', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '16', 'menu_id' => '4', 'page_id' => null, 'position' => '3', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],

            ['id' => '17', 'menu_id' => '5', 'page_id' => null, 'position' => '1', 'target' => '', 'class' => 'first', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '18', 'menu_id' => '5', 'page_id' => null, 'position' => '2', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '19', 'menu_id' => '5', 'page_id' => null, 'position' => '3', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '20', 'menu_id' => '5', 'page_id' => null, 'position' => '4', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 1, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],

            ['id' => '21', 'menu_id' => '6', 'page_id' => null, 'position' => '1', 'target' => '', 'class' => 'first', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 0, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '22', 'menu_id' => '6', 'page_id' => null, 'position' => '2', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 0, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
            ['id' => '23', 'menu_id' => '6', 'page_id' => null, 'position' => '3', 'target' => '', 'class' => '', 'icon_class' => null, 'has_categories' => 0, 'logged' => 1, 'guest' => 0, 'created_at' => '2014-03-28 23:18:49', 'updated_at' => '2014-03-28 18:58:25'],
        ];

        $typi_menulink_translations = [
            ['id' => '1', 'menulink_id' => '1', 'locale' => 'fr', 'status' => '1', 'title' => 'Everything', 'url' => '/', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '2', 'menulink_id' => '1', 'locale' => 'nl', 'status' => '1', 'title' => 'Everything', 'url' => '/', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '3', 'menulink_id' => '1', 'locale' => 'en', 'status' => '1', 'title' => 'Everything', 'url' => '/', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '4', 'menulink_id' => '2', 'locale' => 'fr', 'status' => '1', 'title' => 'Insurance', 'url' => '/insurance', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '5', 'menulink_id' => '2', 'locale' => 'nl', 'status' => '1', 'title' => 'Insurance', 'url' => '/insurance', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '6', 'menulink_id' => '2', 'locale' => 'en', 'status' => '1', 'title' => 'Insurance', 'url' => '/insurance', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '7', 'menulink_id' => '3', 'locale' => 'fr', 'status' => '1', 'title' => 'Clothing', 'url' => '/clothing', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '8', 'menulink_id' => '3', 'locale' => 'nl', 'status' => '1', 'title' => 'Clothing', 'url' => '/clothing', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '9', 'menulink_id' => '3', 'locale' => 'en', 'status' => '1', 'title' => 'Clothing', 'url' => '/clothing', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '10', 'menulink_id' => '4', 'locale' => 'fr', 'status' => '1', 'title' => '#StupidHappenz', 'url' => '/failz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '11', 'menulink_id' => '4', 'locale' => 'nl', 'status' => '1', 'title' => '#StupidHappenz', 'url' => '/failz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '12', 'menulink_id' => '4', 'locale' => 'en', 'status' => '1', 'title' => '#StupidHappenz', 'url' => '/failz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '13', 'menulink_id' => '5', 'locale' => 'fr', 'status' => '1', 'title' => 'Face of ZZ', 'url' => '/face-of-zz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '14', 'menulink_id' => '5', 'locale' => 'nl', 'status' => '1', 'title' => 'Face of ZZ', 'url' => '/face-of-zz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '15', 'menulink_id' => '5', 'locale' => 'en', 'status' => '1', 'title' => 'Face of ZZ', 'url' => '/face-of-zz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '16', 'menulink_id' => '6', 'locale' => 'fr', 'status' => '1', 'title' => 'Music', 'url' => '/music', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '17', 'menulink_id' => '6', 'locale' => 'nl', 'status' => '1', 'title' => 'Music', 'url' => '/music', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '18', 'menulink_id' => '6', 'locale' => 'en', 'status' => '1', 'title' => 'Music', 'url' => '/music', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],


            ['id' => '19', 'menulink_id' => '7', 'locale' => 'fr', 'status' => '1', 'title' => 'Sign In', 'url' => '/auth/login', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '20', 'menulink_id' => '7', 'locale' => 'nl', 'status' => '1', 'title' => 'Sign In', 'url' => '/auth/login', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '21', 'menulink_id' => '7', 'locale' => 'en', 'status' => '1', 'title' => 'Sign In', 'url' => '/auth/login', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '22', 'menulink_id' => '8', 'locale' => 'fr', 'status' => '1', 'title' => 'Sign Out', 'url' => '/auth/logout', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '23', 'menulink_id' => '8', 'locale' => 'nl', 'status' => '1', 'title' => 'Sign Out', 'url' => '/auth/logout', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '24', 'menulink_id' => '8', 'locale' => 'en', 'status' => '1', 'title' => 'Sign Out', 'url' => '/auth/logout', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '25', 'menulink_id' => '9', 'locale' => 'fr', 'status' => '1', 'title' => '', 'url' => '/profile/my-details', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '26', 'menulink_id' => '9', 'locale' => 'nl', 'status' => '1', 'title' => '', 'url' => '/profile/my-details', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '27', 'menulink_id' => '9', 'locale' => 'en', 'status' => '1', 'title' => '', 'url' => '/profile/my-details', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '28', 'menulink_id' => '10', 'locale' => 'fr', 'status' => '1', 'title' => '', 'url' => '/basket', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '29', 'menulink_id' => '10', 'locale' => 'nl', 'status' => '1', 'title' => '', 'url' => '/basket', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '30', 'menulink_id' => '10', 'locale' => 'en', 'status' => '1', 'title' => '', 'url' => '/basket', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],


            ['id' => '31', 'menulink_id' => '11', 'locale' => 'fr', 'status' => '1', 'title' => 'Insurance', 'url' => '/insurance', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '32', 'menulink_id' => '11', 'locale' => 'nl', 'status' => '1', 'title' => 'Insurance', 'url' => '/insurance', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '33', 'menulink_id' => '11', 'locale' => 'en', 'status' => '1', 'title' => 'Insurance', 'url' => '/insurance', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '34', 'menulink_id' => '12', 'locale' => 'fr', 'status' => '1', 'title' => 'Gadget cover', 'url' => '/insurance/gadget-insurance/gadget-insurance', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '35', 'menulink_id' => '12', 'locale' => 'nl', 'status' => '1', 'title' => 'Gadget cover', 'url' => '/insurance/gadget-insurance/gadget-insurance', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '36', 'menulink_id' => '12', 'locale' => 'en', 'status' => '1', 'title' => 'Gadget cover', 'url' => '/insurance/gadget-insurance/gadget-insurance', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '37', 'menulink_id' => '13', 'locale' => 'fr', 'status' => '1', 'title' => 'Excess cover', 'url' => '/insurance/xs-cover/cars-vans-motorbikes-xs-protection', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '38', 'menulink_id' => '13', 'locale' => 'nl', 'status' => '1', 'title' => 'Excess cover', 'url' => '/insurance/xs-cover/cars-vans-motorbikes-xs-protection', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '39', 'menulink_id' => '13', 'locale' => 'en', 'status' => '1', 'title' => 'Excess cover', 'url' => '/insurance/xs-cover/cars-vans-motorbikes-xs-protection', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],


            ['id' => '40', 'menulink_id' => '14', 'locale' => 'fr', 'status' => '1', 'title' => 'Clothing', 'url' => '/clothing', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '41', 'menulink_id' => '14', 'locale' => 'nl', 'status' => '1', 'title' => 'Clothing', 'url' => '/clothing', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '42', 'menulink_id' => '14', 'locale' => 'en', 'status' => '1', 'title' => 'Clothing', 'url' => '/clothing', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '43', 'menulink_id' => '15', 'locale' => 'fr', 'status' => '1', 'title' => 'Boyz', 'url' => '/clothing/boyz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '44', 'menulink_id' => '15', 'locale' => 'nl', 'status' => '1', 'title' => 'Boyz', 'url' => '/clothing/boyz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '45', 'menulink_id' => '15', 'locale' => 'en', 'status' => '1', 'title' => 'Boyz', 'url' => '/clothing/boyz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '46', 'menulink_id' => '16', 'locale' => 'fr', 'status' => '1', 'title' => 'Girlz', 'url' => '/clothing/girlz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '47', 'menulink_id' => '16', 'locale' => 'nl', 'status' => '1', 'title' => 'Girlz', 'url' => '/clothing/girlz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '48', 'menulink_id' => '16', 'locale' => 'en', 'status' => '1', 'title' => 'Girlz', 'url' => '/clothing/girlz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],


            ['id' => '49', 'menulink_id' => '17', 'locale' => 'fr', 'status' => '1', 'title' => 'Any issues?', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '50', 'menulink_id' => '17', 'locale' => 'nl', 'status' => '1', 'title' => 'Any issues?', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '51', 'menulink_id' => '17', 'locale' => 'en', 'status' => '1', 'title' => 'Any issues?', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '52', 'menulink_id' => '18', 'locale' => 'fr', 'status' => '1', 'title' => 'About us', 'url' => '/about-us', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '53', 'menulink_id' => '18', 'locale' => 'nl', 'status' => '1', 'title' => 'About us', 'url' => '/about-us', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '54', 'menulink_id' => '18', 'locale' => 'en', 'status' => '1', 'title' => 'About us', 'url' => '/about-us', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '55', 'menulink_id' => '19', 'locale' => 'fr', 'status' => '1', 'title' => 'Contact us', 'url' => '/contactz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '56', 'menulink_id' => '19', 'locale' => 'nl', 'status' => '1', 'title' => 'Contact us', 'url' => '/contactz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '57', 'menulink_id' => '19', 'locale' => 'en', 'status' => '1', 'title' => 'Contact us', 'url' => '/contactz', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '58', 'menulink_id' => '20', 'locale' => 'fr', 'status' => '1', 'title' => 'faqs', 'url' => '/faqs', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '59', 'menulink_id' => '20', 'locale' => 'nl', 'status' => '1', 'title' => 'faqs', 'url' => '/faqs', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '60', 'menulink_id' => '20', 'locale' => 'en', 'status' => '1', 'title' => 'faqs', 'url' => '/faqs', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],


            ['id' => '61', 'menulink_id' => '21', 'locale' => 'fr', 'status' => '1', 'title' => 'My Account', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '62', 'menulink_id' => '21', 'locale' => 'nl', 'status' => '1', 'title' => 'My Account', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '63', 'menulink_id' => '21', 'locale' => 'en', 'status' => '1', 'title' => 'My Account', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '64', 'menulink_id' => '22', 'locale' => 'fr', 'status' => '1', 'title' => 'My covers', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '65', 'menulink_id' => '22', 'locale' => 'nl', 'status' => '1', 'title' => 'My covers', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '66', 'menulink_id' => '22', 'locale' => 'en', 'status' => '1', 'title' => 'My covers', 'url' => '', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],

            ['id' => '67', 'menulink_id' => '23', 'locale' => 'fr', 'status' => '1', 'title' => 'Account management', 'url' => '/profile', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '68', 'menulink_id' => '23', 'locale' => 'nl', 'status' => '1', 'title' => 'Account management', 'url' => '/profile', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
            ['id' => '69', 'menulink_id' => '23', 'locale' => 'en', 'status' => '1', 'title' => 'Account management', 'url' => '/profile', 'created_at' => '2014-03-28 00:00:00', 'updated_at' => '2014-03-28 00:00:00'],
        ];

        DB::table('menulinks')->insert($typi_menulinks);
        DB::table('menulink_translations')->insert($typi_menulink_translations);
    }
}
