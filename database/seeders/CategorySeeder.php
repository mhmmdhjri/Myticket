<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = 
        [

        ['name'=>'startup',
             'icons'=>null
        ],
        [
           'name'=>'movies',
           'icons'=>null
        ],
        [
            'name'=>'bootcamp',
            'icons'=>null
        ],
        [
            'name'=>'theater',
            'icons'=>null
        ],
        [
            'name'=>'business',
            'icons'=>null
        ],
        [
            'name'=>'game',
            'icons'=>null
        ],
        [
            'name'=>'sport',
            'icons'=>null
         ]

         ];
        //  insert data to tabel categories
        foreach($categories as $category){
            Category::create([
                'name'=>$category['name'],
                'icons'=>$category ['icons'],
            ]);
        }
    }
}
