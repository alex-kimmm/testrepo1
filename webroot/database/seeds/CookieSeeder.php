<?php

use Illuminate\Database\Seeder;

class CookieSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('blocks')->insert([
            [
                'name'=>'cookie',
                'created_at'=>'2016-04-01 17:09:53',
                'updated_at'=>'2016-04-01 17:09:53',
            ]
        ]);

        // temporary
        $blocks_translations = [
            ['id' => 1, 'block_id' => 1, 'locale' => 'en', 'status' => 1, 'body' => '<p>We use cookies to ensure you get the best experience on our website. Please click the button below to accept cookies and hide this message.</p>', 'created_at' => '2016-04-01 17:30:06', 'updated_at' => '2016-04-01 17:30:06'],
            ['id' => 2, 'block_id' => 1, 'locale' => 'fr', 'status' => 1, 'body' => '<p>We use cookies to ensure you get the best experience on our website. Please click the button below to accept cookies and hide this message.</p>', 'created_at' => '2016-04-01 17:30:06', 'updated_at' => '2016-04-01 17:30:06'],
            ['id' => 3, 'block_id' => 1, 'locale' => 'nl', 'status' => 1, 'body' => '<p>We use cookies to ensure you get the best experience on our website. Please click the button below to accept cookies and hide this message.</p>', 'created_at' => '2016-04-01 17:30:06', 'updated_at' => '2016-04-01 17:30:06'],
        ];

        DB::table('block_translations')->insert($blocks_translations);
    }
}
