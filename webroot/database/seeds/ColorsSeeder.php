<?php

use Illuminate\Database\Seeder;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            ['id' => '1', 'color_code'=>'ffffff', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '2', 'color_code'=>'ff0000', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '3', 'color_code'=>'ff6600', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '4', 'color_code'=>'ffff00', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '5', 'color_code'=>'008000', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '6', 'color_code'=>'0000ff', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '7', 'color_code'=>'800080', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '8', 'color_code'=>'000000', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],

        ];

        $color_translations = [
            ['id' => '1', 'color_id' => '1', 'locale' => 'en', 'status' => '1', 'title' => 'White', 'slug' => 'white', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '2', 'color_id' => '1', 'locale' => 'fr', 'status' => '1', 'title' => 'Blanc', 'slug' => 'blanc', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '3', 'color_id' => '1', 'locale' => 'nl', 'status' => '1', 'title' => 'Wit', 'slug' => 'wit', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

            ['id' => '4', 'color_id' => '2', 'locale' => 'en', 'status' => '1', 'title' => 'Red', 'slug' => 'red', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '5', 'color_id' => '2', 'locale' => 'fr', 'status' => '1', 'title' => 'Rouge', 'slug' => 'rouge', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '6', 'color_id' => '2', 'locale' => 'nl', 'status' => '1', 'title' => 'Rood', 'slug' => 'rood', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

            ['id' => '7', 'color_id' => '3', 'locale' => 'en', 'status' => '1', 'title' => 'Orange', 'slug' => 'orange', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '8', 'color_id' => '3', 'locale' => 'fr', 'status' => '1', 'title' => 'Orange', 'slug' => 'orange', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '9', 'color_id' => '3', 'locale' => 'nl', 'status' => '1', 'title' => 'Oranje', 'slug' => 'oranje', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

            ['id' => '10', 'color_id' => '4', 'locale' => 'en', 'status' => '1', 'title' => 'Yellow', 'slug' => 'yellow', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '11', 'color_id' => '4', 'locale' => 'fr', 'status' => '1', 'title' => 'Jaune', 'slug' => 'jaune', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '12', 'color_id' => '4', 'locale' => 'nl', 'status' => '1', 'title' => 'Geel', 'slug' => 'geel', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

            ['id' => '13', 'color_id' => '5', 'locale' => 'en', 'status' => '1', 'title' => 'Green', 'slug' => 'green', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '14', 'color_id' => '5', 'locale' => 'fr', 'status' => '1', 'title' => 'Vert', 'slug' => 'vert', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '15', 'color_id' => '5', 'locale' => 'nl', 'status' => '1', 'title' => 'Groen', 'slug' => 'groen', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

            ['id' => '16', 'color_id' => '6', 'locale' => 'en', 'status' => '1', 'title' => 'Blue', 'slug' => 'blue', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '17', 'color_id' => '6', 'locale' => 'fr', 'status' => '1', 'title' => 'Bleu', 'slug' => 'bleu', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '18', 'color_id' => '6', 'locale' => 'nl', 'status' => '1', 'title' => 'Blauw', 'slug' => 'blauw', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

            ['id' => '19', 'color_id' => '7', 'locale' => 'en', 'status' => '1', 'title' => 'Purple', 'slug' => 'purple', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '20', 'color_id' => '7', 'locale' => 'fr', 'status' => '1', 'title' => 'Violet', 'slug' => 'violet', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '21', 'color_id' => '7', 'locale' => 'nl', 'status' => '1', 'title' => 'Purper', 'slug' => 'purper', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

            ['id' => '22', 'color_id' => '8', 'locale' => 'en', 'status' => '1', 'title' => 'Black', 'slug' => 'black', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '23', 'color_id' => '8', 'locale' => 'fr', 'status' => '1', 'title' => 'Noir', 'slug' => 'noir', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '24', 'color_id' => '8', 'locale' => 'nl', 'status' => '1', 'title' => 'Zwart', 'slug' => 'zwart', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

        ];

        DB::table('colors')->insert($colors);
        DB::table('color_translations')->insert($color_translations);

    }
}
