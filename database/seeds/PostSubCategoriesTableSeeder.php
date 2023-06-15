<?php

use Illuminate\Database\Seeder;

class PostSubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //sub_category
        DB::table('post_sub_categories')->insert([
            [
                'post_main_category_id' => '1',
                'sub_category' => 'おすすめ'
            ],
            [
                'post_main_category_id' => '2',
                'sub_category' => 'マナー'
            ],
            [
                'post_main_category_id' => '3',
                'sub_category' => 'おいしい店'
            ],
            [
                'post_main_category_id' => '4',
                'sub_category' => 'おすすめ料理'
            ],
        ]);
    }
}
