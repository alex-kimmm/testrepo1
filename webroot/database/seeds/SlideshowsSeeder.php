<?php

use Illuminate\Database\Seeder;

class SlideshowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slideshows = [
            ['id' => '1', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '2', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
        ];

        $slideshow_translations = [
            ['id' => '1', 'slideshow_id' => '1', 'locale' => 'en', 'status' => '1', 'title' => 'homepage', 'slug' => 'homepage', 'summary' => 'some text', 'body' => 'some text', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '2', 'slideshow_id' => '1', 'locale' => 'fr', 'status' => '1', 'title' => 'homepage', 'slug' => 'homepage', 'summary' => 'some text', 'body' => 'some text', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '3', 'slideshow_id' => '1', 'locale' => 'nl', 'status' => '1', 'title' => 'homepage', 'slug' => 'homepage', 'summary' => 'some text', 'body' => 'some text', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '4', 'slideshow_id' => '2', 'locale' => 'en', 'status' => '1', 'title' => 'clothing', 'slug' => 'clothing', 'summary' => 'some text', 'body' => 'some text', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '5', 'slideshow_id' => '2', 'locale' => 'fr', 'status' => '1', 'title' => 'clothing', 'slug' => 'clothing', 'summary' => 'some text', 'body' => 'some text', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '6', 'slideshow_id' => '2', 'locale' => 'nl', 'status' => '1', 'title' => 'clothing', 'slug' => 'clothing', 'summary' => 'some text', 'body' => 'some text', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],

        ];

        $product_slideshows = [
            ['product_id' =>'1', 'slideshow_id' =>'1', 'product_slideshow_type' => 'TypiCMS\\Modules\\Slideshows\\Models\\Slideshow', 'position' => '0', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['product_id' =>'2', 'slideshow_id' =>'1', 'product_slideshow_type' => 'TypiCMS\\Modules\\Slideshows\\Models\\Slideshow', 'position' => '1', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['product_id' =>'3', 'slideshow_id' =>'1', 'product_slideshow_type' => 'TypiCMS\\Modules\\Slideshows\\Models\\Slideshow', 'position' => '2', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['product_id' =>'4', 'slideshow_id' =>'2', 'product_slideshow_type' => 'TypiCMS\\Modules\\Slideshows\\Models\\Slideshow', 'position' => '0', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['product_id' =>'5', 'slideshow_id' =>'2', 'product_slideshow_type' => 'TypiCMS\\Modules\\Slideshows\\Models\\Slideshow', 'position' => '1', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['product_id' =>'6', 'slideshow_id' =>'2', 'product_slideshow_type' => 'TypiCMS\\Modules\\Slideshows\\Models\\Slideshow', 'position' => '2', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
        ];

        DB::table('slideshows')->insert($slideshows);
        DB::table('slideshow_translations')->insert($slideshow_translations);
        DB::table('product_slideshows')->insert($product_slideshows);
    }
}
