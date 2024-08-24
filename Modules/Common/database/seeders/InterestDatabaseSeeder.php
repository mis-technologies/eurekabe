<?php

namespace Modules\Common\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\Models\Interest;

class SchoolDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $collegeSubjects = [
            "Advanced Physics",
            "Organic Chemistry",
            "Biochemistry",
            "Molecular Biology",
            "Genetics",
            "Thermodynamics",
            "Quantum Mechanics",
            "Electrodynamics",
            "Analytical Chemistry",
            "Physical Chemistry",
            "Cell Biology",
            "Ecology",
            "Human Anatomy",
            "Astrophysics",
            "Materials Science",
            "Chemical Engineering",
            "Structural Biology",
            "Neuroscience",
            "Environmental Chemistry",
            "Microbiology",
            "Advanced Organic Chemistry"
        ];

        foreach ($collegeSubjects as $interest) {
            Interest::create(['name' => $interest]);
        }
    }
}
