<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class FailzSeederTableSeeder extends Seeder
{
    public function run()
    {

        $failz = [
            ['id' => '1', 'obj_link' => 'http://orig15.deviantart.net/0db9/f/2012/191/9/c/link_gif_by_mtotheaggie-d56pcxf.gif', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '2', 'obj_link' => 'http://orig15.deviantart.net/0db9/f/2012/191/9/c/link_gif_by_mtotheaggie-d56pcxf.gif', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '3', 'obj_link' => 'http://orig15.deviantart.net/0db9/f/2012/191/9/c/link_gif_by_mtotheaggie-d56pcxf.gif', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '4', 'obj_link' => 'http://orig15.deviantart.net/0db9/f/2012/191/9/c/link_gif_by_mtotheaggie-d56pcxf.gif', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
        ];

        $failz_translations = [
            ['id' => '1', 'failz_id' => '1', 'status' => 1, 'locale' => 'en', 'title' => 'Title gif 1', 'slug' => 'g1', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '2', 'failz_id' => '1', 'status' => 1, 'locale' => 'fr', 'title' => 'Title gif 1', 'slug' => 'g1', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '3', 'failz_id' => '1', 'status' => 1, 'locale' => 'nl', 'title' => 'Title gif 1', 'slug' => 'g1', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '4', 'failz_id' => '2', 'status' => 1, 'locale' => 'en', 'title' => 'Title gif 2', 'slug' => 'g2', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '5', 'failz_id' => '2', 'status' => 1, 'locale' => 'fr', 'title' => 'Title gif 2', 'slug' => 'g2', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '6', 'failz_id' => '2', 'status' => 1, 'locale' => 'nl', 'title' => 'Title gif 2', 'slug' => 'g2', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '7', 'failz_id' => '3', 'status' => 1, 'locale' => 'en', 'title' => 'Title gif 3', 'slug' => 'g3', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '8', 'failz_id' => '3', 'status' => 1, 'locale' => 'fr', 'title' => 'Title gif 3', 'slug' => 'g3', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '9', 'failz_id' => '3', 'status' => 1, 'locale' => 'nl', 'title' => 'Title gif 3', 'slug' => 'g3', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '10', 'failz_id' => '4', 'status' => 1, 'locale' => 'en', 'title' => 'Title gif 4', 'slug' => 'g4', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '11', 'failz_id' => '4', 'status' => 1, 'locale' => 'fr', 'title' => 'Title gif 4', 'slug' => 'g4', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '12', 'failz_id' => '4', 'status' => 1, 'locale' => 'nl', 'title' => 'Title gif 4', 'slug' => 'g4', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

        ];

        DB::table('failzs')->insert($failz);
        DB::table('failz_translations')->insert($failz_translations);
    }
}
