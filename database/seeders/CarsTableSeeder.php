<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cars')->insert([
            ['make' => 'PROTON', 'year' => 2022, 'model' => 'X50', 'variant' => 'EXECUTIVE', 'price' => 80000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PROTON', 'year' => 2022, 'model' => 'X50', 'variant' => 'PREMIUM', 'price' => 100000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PROTON', 'year' => 2023, 'model' => 'X50', 'variant' => 'EXECUTIVE', 'price' => 90000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PROTON', 'year' => 2023, 'model' => 'X50', 'variant' => 'PREMIUM', 'price' => 110000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PROTON', 'year' => 2021, 'model' => 'X70', 'variant' => 'TGDI EXECUTIVE', 'price' => 95000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PROTON', 'year' => 2021, 'model' => 'X70', 'variant' => 'TGDI PREMIUM', 'price' => 105000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PROTON', 'year' => 2022, 'model' => 'X70', 'variant' => 'TGDI EXECUTIVE', 'price' => 100000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PROTON', 'year' => 2022, 'model' => 'X70', 'variant' => 'TGDI PREMIUM', 'price' => 120000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PROTON', 'year' => 2022, 'model' => 'X70', 'variant' => 'TGDI STANDARD', 'price' => 110000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PERODUA', 'year' => 2021, 'model' => 'MYVI', 'variant' => 'AV', 'price' => 40000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PERODUA', 'year' => 2021, 'model' => 'MYVI', 'variant' => 'EXTREME', 'price' => 45000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PERODUA', 'year' => 2022, 'model' => 'MYVI', 'variant' => 'AV', 'price' => 45000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PERODUA', 'year' => 2022, 'model' => 'MYVI', 'variant' => 'EXTREME', 'price' => 50000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PERODUA', 'year' => 2022, 'model' => 'AXIA', 'variant' => 'E', 'price' => 30000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PERODUA', 'year' => 2023, 'model' => 'MYVI', 'variant' => 'EXTREME', 'price' => 55000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PERODUA', 'year' => 2023, 'model' => 'AXIA', 'variant' => 'E', 'price' => 40000.00, 'created_at' => now(), 'updated_at' => now()],
            ['make' => 'PERODUA', 'year' => 2023, 'model' => 'ALZA', 'variant' => 'AV', 'price' => 70000.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
