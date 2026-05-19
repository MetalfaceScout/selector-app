<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Manually add centers
        $centers = [
            ['center_id' => 0, 'short_name' => 'N/A', 'pretty_name' => 'All Centers'],
            ['center_id' => 17, 'short_name' => 'STG', 'pretty_name' => 'St. George'],
            ['center_id' => 10, 'short_name' => 'LLT', 'pretty_name' => 'Loveland Lasertag'],
            ['center_id' => 8, 'short_name' => 'SYC', 'pretty_name' => 'Syracuse'],
            ['center_id' => 5, 'short_name' => 'BRS', 'pretty_name' => 'Brisbane'],
            ['center_id' => 7, 'short_name' => 'DET', 'pretty_name' => 'Detroit'],
        ];

        foreach ($centers as $center) {
            \App\Models\Center::create($center);
        }
    }
}
