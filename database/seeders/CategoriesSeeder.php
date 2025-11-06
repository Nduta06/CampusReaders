<?php

namespace Database\Seeders;

use App\Models\categories;
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
        categories::truncate();

        $Science = new Categories();
        $Science->name = 'Science';
        $Science->description = 'Books related to Science';
        $Science->save();

        $Business = new Categories();
        $Business->name = 'Business';
        $Business->description = 'Books related to Business';
        $Business->save();

        $Technology = new Categories();
        $Technology->name = 'Technology';
        $Technology->description = 'Books related to Technology';
        $Technology->save();

        $Fiction = new Categories();
        $Fiction->name = 'Fiction';
        $Fiction->description = 'Fictional Books';
        $Fiction->save();

        $History = new Categories();
        $History->name = 'History';
        $History->description = 'Books related to History';
        $History->save();

        Schema::enableForeignKeyConstraints();
    }
}
