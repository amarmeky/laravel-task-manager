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
        $categories = [
            "Work",
            "Personal",
            "Urgent",
            "Shopping",
            "Health",
            "Travel",
            "Education",
            "Fitness",
        ];
        foreach($categories as $categ)
        {
            Category::create(['name'=>$categ]);
        }
    }
}
