<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'Procurement',
            'Finance',
            'Customer Service',
            'Human Resources',
            'Quality Assurance',
            'ICT Office',
            'Marketing',
            'Sales',
            'Research and Development'
        ];

        foreach ($departments as $departmentName) {
            Department::create(['name' => $departmentName]);
        }
    }
}
