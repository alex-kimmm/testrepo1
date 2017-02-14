<?php

use Illuminate\Database\Seeder;

class QuotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quotes = [
            ['id' => '1', 'position' => '1', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
        ];

        $quote_translations = [
            ['id' => '1', 'quote_id' => '1', 'locale' => 'en', 'title' => 'insurance age', 'slug' => 'home','summary' => '', 'status'=>'1', 'body' => '<p>Name one</p><p>to watch</p><p>in 2016</p>', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
            ['id' => '2', 'quote_id' => '1', 'locale' => 'fr', 'title' => 'insurance age', 'slug' => 'home','summary' => '', 'status'=>'1', 'body' => '<p>Name one</p><p>to watch</p><p>in 2016</p>', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2013-11-20 20:06:24'],
            ['id' => '3', 'quote_id' => '1', 'locale' => 'nl', 'title' => 'insurance age', 'slug' => 'home','summary' => '', 'status'=>'1', 'body' => '<p>Name one</p><p>to watch</p><p>in 2016</p>', 'created_at' => '2013-11-20 20:06:24', 'updated_at' => '2014-03-18 12:48:01'],
        ];

        DB::table('quotes')->insert($quotes);
        DB::table('quote_translations')->insert($quote_translations);
    }
}
