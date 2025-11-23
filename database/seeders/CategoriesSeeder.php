<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();
        Category::truncate();


        $Science = new Category();
        $Science->name = 'Science';
        $Science->description = 'Books related to Science';
        $Science->save();

        $Business = new Category();
        $Business->name = 'Business';
        $Business->description = 'Books related to Business';
        $Business->save();

        $Technology = new Category();
        $Technology->name = 'Technology';
        $Technology->description = 'Books related to Technology';
        $Technology->save();

        $Fiction = new Category();
        $Fiction->name = 'Fiction';
        $Fiction->description = 'Fictional Books';
        $Fiction->save();

        $History = new Category();
        $History->name = 'History';
        $History->description = 'Books related to History';
        $History->save();

        Schema::enableForeignKeyConstraints();
    }
}
