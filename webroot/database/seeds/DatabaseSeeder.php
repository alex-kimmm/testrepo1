<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(SettingsSeeder::class);
        $this->call(TranslationSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(MenulinkSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(ColorsSeeder::class);
        $this->call(UserTitlesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(FailzSeederTableSeeder::class);
        $this->call(FailzTagsTableSeeder::class);
        $this->call(CookieSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(SizesSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(QuotesSeeder::class);
//        $this->call(SlideshowsSeeder::class);
        Model::reguard();
    }
}
