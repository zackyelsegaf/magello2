<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MataUang>
 */
class MataUangFactory extends Factory
{
    protected static $csvData;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Load CSV data sekali saja (cache di static variable)
        if (is_null(self::$csvData)) {
            $csvPath = database_path('csvs/countries.csv');

            if (!File::exists($csvPath)) {
                throw new \Exception("CSV file not found at $csvPath");
            }

            $rows = array_map('str_getcsv', file($csvPath));
            $header = array_map('trim', array_shift($rows));

            self::$csvData = array_map(function ($row) use ($header) {
                return array_combine($header, $row);
            }, $rows);
        }

        $country = fake()->randomElement(self::$csvData);

        return [
            'kode' => $country['currency'],
            'nama' => $country['currency_name'],
        ];
    }
}
