<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $products = [
            ['id' => '1', 'image' => NULL, 'sku' => '100', 'price' => '100.00', 'featured' => '0', 'options' => NULL, 'category_id' => '4', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '2', 'image' => NULL, 'sku' => '115', 'price' => '120.00', 'featured' => '0', 'options' => NULL, 'category_id' => '4', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '3', 'image' => NULL, 'sku' => '116', 'price' => '89.00',  'featured' => '0', 'options' => NULL, 'category_id' => '5', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '4', 'image' => NULL, 'sku' => '120', 'price' => '120.00', 'featured' => '0', 'options' => NULL, 'category_id' => '5', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '5', 'image' => NULL, 'sku' => '125', 'price' => '115.00', 'featured' => '0', 'options' => NULL, 'category_id' => '6', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '6', 'image' => NULL, 'sku' => '130', 'price' => '105.00', 'featured' => '0', 'options' => NULL, 'category_id' => '6', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
        ];

        $product_translations = [
            ['id' => '1', 'product_id' => '1', 'locale' => 'en', 'status' => '1', 'title' => 'T-Shirt', 'slug' => 't-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '2', 'product_id' => '1', 'locale' => 'fr', 'status' => '0', 'title' => 'T-Shirt', 'slug' => 't-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '3', 'product_id' => '1', 'locale' => 'nl', 'status' => '0', 'title' => 'T-Shirt', 'slug' => 't-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],

            ['id' => '4', 'product_id' => '2', 'locale' => 'en', 'status' => '1', 'title' => 'Star Wars T-Shirt', 'slug' => 'star-wars-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '5', 'product_id' => '2', 'locale' => 'fr', 'status' => '0', 'title' => 'Star Wars T-Shirt', 'slug' => 'star-wars-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '6', 'product_id' => '2', 'locale' => 'nl', 'status' => '0', 'title' => 'Star Wars T-Shirt', 'slug' => 'star-wars-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],

            ['id' => '7', 'product_id' => '3', 'locale' => 'en', 'status' => '1', 'title' => 'Awesome T-Shirt', 'slug' => 'awesome-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '8', 'product_id' => '3', 'locale' => 'fr', 'status' => '0', 'title' => 'Awesome T-Shirt', 'slug' => 'awesome-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '9', 'product_id' => '3', 'locale' => 'nl', 'status' => '0', 'title' => 'Awesome T-Shirt', 'slug' => 'awesome-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],

            ['id' => '10', 'product_id' => '4', 'locale' => 'en', 'status' => '1', 'title' => 'Sport T-Shirt', 'slug' => 'sport-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '11', 'product_id' => '4', 'locale' => 'fr', 'status' => '0', 'title' => 'Sport T-Shirt', 'slug' => 'sport-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '12', 'product_id' => '4', 'locale' => 'nl', 'status' => '0', 'title' => 'Sport T-Shirt', 'slug' => 'sport-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],

            ['id' => '13', 'product_id' => '5', 'locale' => 'en', 'status' => '1', 'title' => 'The Special One T-Shirt', 'slug' => 'the-special-one-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '14', 'product_id' => '5', 'locale' => 'fr', 'status' => '0', 'title' => 'The Special One T-Shirt', 'slug' => 'the-special-one-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '15', 'product_id' => '5', 'locale' => 'nl', 'status' => '0', 'title' => 'The Special One T-Shirt', 'slug' => 'the-special-one-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],

            ['id' => '16', 'product_id' => '6', 'locale' => 'en', 'status' => '1', 'title' => 'ZugarZnap T-Shirt', 'slug' => 'zugarznap-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '17', 'product_id' => '6', 'locale' => 'fr', 'status' => '0', 'title' => 'ZugarZnap T-Shirt', 'slug' => 'zugarznap-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
            ['id' => '18', 'product_id' => '6', 'locale' => 'nl', 'status' => '0', 'title' => 'ZugarZnap T-Shirt', 'slug' => 'zugarznap-t-shirt', 'summary' => '', 'body' => '', 'created_at' => '2016-04-08 12:49:37', 'updated_at' => '2016-04-08 12:49:37'],
        ];

        DB::table('products')->insert($products);
        DB::table('product_translations')->insert($product_translations);
    }
}
