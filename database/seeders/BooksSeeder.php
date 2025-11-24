<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Faker\Factory as Faker;

class BookSeeder extends Seeder implements ToCollection, WithHeadingRow
{
    private $faker;
    
    // Mapping CSV categories to your existing DB category IDs (1-5)
    private $categoryMap = [
        'history'                => 5, // History
        'biography'              => 5, // History
        'autobiography'          => 5, // History
        'historical novel'       => 5, // History
        'historical fiction'     => 5, // History
        
        'business'               => 2, // Business
        'economics'              => 2, // Business
        'management'             => 2, // Business
        'personal development'   => 2, // Business

        'fiction'                => 4, // Fiction
        'philosophical fiction'  => 4, // Fiction
        'high fantasy'           => 4, // Fiction
        'story'                  => 4, // Fiction
        'arts'                   => 4, // Fiction (as general interest)
        'photography'            => 4, // Fiction (as general interest)

        'science'                => 1, // Science (Social/Applied Science)
        'education'              => 1,
        'philosophy'             => 1,
        'space'                  => 1,
        'law'                    => 1,
        'health'                 => 1,
    ];

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Path to your CSV file
        $path = database_path('seeders/data/book_data.csv');
        
        // Ensure the CategorySeeder has run first!
        // You can also use DB::table('books')->truncate(); here if needed.

        if (File::exists($path)) {
            // Use the ToCollection implementation (this class itself) to process the CSV
            Excel::import($this, $path);
        } else {
            $this->command->warn('Book data CSV not found at: ' . $path);
        }
    }

    /**
     * Handles the collection of rows from the CSV file.
     * @param Collection $rows
     * @return void
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // --- 1. Category Mapping ---
            $csvCategory = strtolower($row['category']);
            $categoryId = $this->categoryMap[$csvCategory] ?? 4; // Default to Fiction (4) if no match

            // --- 2. Random Data Generation ---
            $totalCopies = $this->faker->numberBetween(5, 20);
            $availableCopies = $this->faker->numberBetween(1, $totalCopies);
            $publicationYear = $this->faker->numberBetween(1980, date('Y'));
            
            // --- 3. Insert into the Books Table ---
            DB::table('books')->insert([
                'category_id'      => $categoryId,
                'title'            => $row['title'],
                'author'           => $row['author'],
                
                // Filling in missing required data
                'ISBN'             => $this->faker->isbn13(),
                'edition'          => $this->faker->randomElement(['1st', '2nd', 'Revised']),
                'publication_year' => $publicationYear,
                'total_copies'     => $totalCopies,
                'available_copies' => $availableCopies,
                'manual_sync_flag' => 0,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }
    }
}