<?php

use Illuminate\Database\Seeder;

class PostMainCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //main_category
        DB::table('post_main_categories')->insert([
            ['main_category' => '和食'],
            ['main_category' => '洋食'],
            ['main_category' => '中華'],
            ['main_category' => 'その他']
        ]);
    }
}
