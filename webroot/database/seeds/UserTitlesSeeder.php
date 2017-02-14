<?php

use Illuminate\Database\Seeder;

class UserTitlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usertitles = [
            ['id' => '1', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '2', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '3', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '4', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
        ];

        $usertitle_translations = [
            ['id' => '1', 'usertitle_id' => '1', 'locale' => 'en', 'title' => '-', 'slug' => NULL, 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '2', 'usertitle_id' => '1', 'locale' => 'fr', 'title' => '-', 'slug' => NULL, 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '3', 'usertitle_id' => '1', 'locale' => 'nl', 'title' => '-', 'slug' => NULL, 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '4', 'usertitle_id' => '2', 'locale' => 'en', 'title' => 'Mr.', 'slug' => 'mr', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '5', 'usertitle_id' => '2', 'locale' => 'fr', 'title' => 'Mr.', 'slug' => 'mr', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '6', 'usertitle_id' => '2', 'locale' => 'nl', 'title' => 'Mr.', 'slug' => 'mr', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '7', 'usertitle_id' => '3', 'locale' => 'en', 'title' => 'Mrs.', 'slug' => 'mrs', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '8', 'usertitle_id' => '3', 'locale' => 'fr', 'title' => 'Mrs.', 'slug' => 'mrs', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '9', 'usertitle_id' => '3', 'locale' => 'nl', 'title' => 'Mrs.', 'slug' => 'mrs', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '10', 'usertitle_id' => '4', 'locale' => 'en', 'title' => 'Miss', 'slug' => 'miss', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '11', 'usertitle_id' => '4', 'locale' => 'fr', 'title' => 'Miss', 'slug' => 'miss', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '12', 'usertitle_id' => '4', 'locale' => 'nl', 'title' => 'Miss', 'slug' => 'miss', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

        ];

        DB::table('usertitles')->insert($usertitles);
        DB::table('usertitle_translations')->insert($usertitle_translations);
    }
}
