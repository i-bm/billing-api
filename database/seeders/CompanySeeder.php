<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Oxygen Health',
                'email' => 'support@oxygenhealth.tech',
                'code' => 'OX-'.random_int(10000,99999),
                'user_id' => 1

            ],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
