<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Country::factory()->count(50)->create();
        // Country::truncate();
        $countries = [
            ['name' => 'مصر'],
            ['name' => 'السعودية'],
            ['name' => 'الإمارات'],
            ['name' => 'الكويت'],
            ['name' => 'قطر'],
            ['name' => 'البحرين'],
            ['name' => 'عمان'],
            ['name' => 'اليمن'],
            ['name' => 'سوريا'],
            ['name' => 'لبنان'],
            ['name' => 'الأردن'],
            ['name' => 'فلسطين'],
            ['name' => 'العراق'],
            ['name' => 'المغرب'],
            ['name' => 'الجزائر'],
            ['name' => 'تونس'],
            ['name' => 'ليبيا'],
            ['name' => 'السودان'],
            ['name' => 'الصومال'],
            ['name' => 'جيبوتي'],
            ['name' => 'موريتانيا'],
            ['name' => 'جزر القمر'],
            ['name' => 'عمان'],
            ['name' => 'اليمن'],
            ['name' => 'سوريا'],
            ['name' => 'لبنان'],
            ['name' => 'الأردن'],
            ['name' => 'فلسطين'],
            ['name' => 'العراق'],
            ['name' => 'المغرب'],
            ['name' => 'الجزائر'],
            ['name' => 'تونس'],
            ['name' => 'ليبيا'],
            ['name' => 'السودان'],
            ['name' => 'الصومال'],
            ['name' => 'جيبوتي'],
            ['name' => 'موريتانيا'],
            ['name' => 'جزر القمر']
        ];
        Country::insert($countries);

    }
};