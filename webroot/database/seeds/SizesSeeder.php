<?php

use Illuminate\Database\Seeder;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            ['id' => '1', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '2', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '3', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '4', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '5', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '6', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '7', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '8', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],

        ];

        $size_translations = [
            ['id' => '1', 'size_id' => '1', 'locale' => 'en', 'status' => '1', 'title' => 'XXXS', 'slug' => 'xxxs', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '2', 'size_id' => '1', 'locale' => 'fr', 'status' => '1', 'title' => '28', 'slug' => '28', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '3', 'size_id' => '1', 'locale' => 'nl', 'status' => '1', 'title' => '24', 'slug' => '24', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

            ['id' => '4', 'size_id' => '2', 'locale' => 'en', 'status' => '1', 'title' => 'XXS', 'slug' => 'xxs', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '5', 'size_id' => '2', 'locale' => 'fr', 'status' => '1', 'title' => '30', 'slug' => '30', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '6', 'size_id' => '2', 'locale' => 'nl', 'status' => '1', 'title' => '26', 'slug' => '26', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

            ['id' => '7', 'size_id' => '3', 'locale' => 'en', 'status' => '1', 'title' => 'XS', 'slug' => 'xs', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '8', 'size_id' => '3', 'locale' => 'fr', 'status' => '1', 'title' => '32-34', 'slug' => '32-34', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '9', 'size_id' => '3', 'locale' => 'nl', 'status' => '1', 'title' => '28-30', 'slug' => '28-30', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

            ['id' => '10', 'size_id' => '4', 'locale' => 'en', 'status' => '1', 'title' => 'S', 'slug' => 's', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '11', 'size_id' => '4', 'locale' => 'fr', 'status' => '1', 'title' => '36-38', 'slug' => '36-38', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '12', 'size_id' => '4', 'locale' => 'nl', 'status' => '1', 'title' => '34', 'slug' => '34', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

            ['id' => '13', 'size_id' => '5', 'locale' => 'en', 'status' => '1', 'title' => 'M', 'slug' => 'm', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '14', 'size_id' => '5', 'locale' => 'fr', 'status' => '1', 'title' => '40-42', 'slug' => '40-42', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '15', 'size_id' => '5', 'locale' => 'nl', 'status' => '1', 'title' => '36-38', 'slug' => '36-38', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

            ['id' => '16', 'size_id' => '6', 'locale' => 'en', 'status' => '1', 'title' => 'L', 'slug' => 'l', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '17', 'size_id' => '6', 'locale' => 'fr', 'status' => '1', 'title' => '44-46', 'slug' => '44-46', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '18', 'size_id' => '6', 'locale' => 'nl', 'status' => '1', 'title' => '40-42', 'slug' => '40-42', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

            ['id' => '19', 'size_id' => '7', 'locale' => 'en', 'status' => '1', 'title' => 'XL', 'slug' => 'xl', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '20', 'size_id' => '7', 'locale' => 'fr', 'status' => '1', 'title' => '48-50', 'slug' => '48-50', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '21', 'size_id' => '7', 'locale' => 'nl', 'status' => '1', 'title' => '44-46', 'slug' => '44-46', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

            ['id' => '22', 'size_id' => '8', 'locale' => 'en', 'status' => '1', 'title' => 'XXL', 'slug' => 'xxl', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '23', 'size_id' => '8', 'locale' => 'fr', 'status' => '1', 'title' => '52', 'slug' => '52', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '24', 'size_id' => '8', 'locale' => 'nl', 'status' => '1', 'title' => '48', 'slug' => '48', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

        ];

        DB::table('sizes')->insert($sizes);
        DB::table('size_translations')->insert($size_translations);

    }
}
