<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class FailzTagsTableSeeder extends Seeder
{
    public function run()
    {

        $failz_tags = [
            ['id' => '1', 'name' => 'cat', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
            ['id' => '2', 'name' => 'dog', 'created_at' => '2016-03-31 21:49:37', 'updated_at' => '2016-03-31 21:49:37'],
        ];

        $failz_tags_pivot = [
            ['failz_id' => '1', 'tag_id' => '1'],
            ['failz_id' => '1', 'tag_id' => '2'],

        ];

        DB::table('failz_tags')->insert($failz_tags);
        DB::table('failz_tags_pivot')->insert($failz_tags_pivot);
    }
}
