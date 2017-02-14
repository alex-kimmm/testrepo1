<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => '1', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '2', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37']
        ];

        $categories_translate = [
            ['id' => '1', 'category_id' => '1', 'status' => 1, 'locale' => 'en', 'title' => 'Insurance', 'slug' => 'insurance', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '2', 'category_id' => '2', 'status' => 1, 'locale' => 'en', 'title' => 'Clothes', 'slug' => 'clothes', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01']
        ];

        $sub_categories = [
            ['id' => '3', 'parent_id' => 1, 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '4', 'parent_id' => 2, 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '5', 'parent_id' => 2, 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '6', 'parent_id' => 2, 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '7', 'parent_id' => 1, 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
        ];

        $sub_categories_translate = [
            ['id' => '3', 'category_id' => '3', 'status' => 1, 'locale' => 'en', 'title' => 'Gadget Insurance', 'slug' => 'gadget-insurance', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '4', 'category_id' => '4', 'status' => 1, 'locale' => 'en', 'title' => 'Boyz', 'slug' => 'boyz', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '5', 'category_id' => '5', 'status' => 1, 'locale' => 'en', 'title' => 'Girlz', 'slug' => 'girlz', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '6', 'category_id' => '6', 'status' => 1, 'locale' => 'en', 'title' => 'Special', 'slug' => 'special', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '7', 'category_id' => '7', 'status' => 1, 'locale' => 'en', 'title' => 'XS Cover', 'slug' => 'xs-cover', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
        ];

        DB::table('categories')->insert($categories);
        DB::table('category_translations')->insert($categories_translate);

        DB::table('categories')->insert($sub_categories);
        DB::table('category_translations')->insert($sub_categories_translate);
    }
}
