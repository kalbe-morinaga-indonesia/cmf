<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        Department::create([
            'txtIdDept' => "DPN-0003",
            'divisi_id' => 2,
            'txtNamaDept' => "BDA",
        ]);

        Department::create([
            'txtIdDept' => "DPN-0002",
            'divisi_id' => 1,
            'txtNamaDept' => "IOS",
        ]);

        Department::create([
            'txtIdDept' => "DPN-0008",
            'divisi_id' => 2,
            'txtNamaDept' => "HC",
        ]);

        Department::create([
            'txtIdDept' => "DPN-0005",
            'divisi_id' => 1,
            'txtNamaDept' => "ENG",
        ]);

        Department::create([
            'txtIdDept' => "DPN-0007",
            'divisi_id' => 1,
            'txtNamaDept' => "QA",
        ]);

        Department::create([
            'txtIdDept' => "DPN-0009",
            'divisi_id' => 1,
            'txtNamaDept' => "MDP",
        ]);

        Department::create([
            'txtIdDept' => "DPN-0006",
            'divisi_id' => 1,
            'txtNamaDept' => "WH",
        ]);

        Department::create([
            'txtIdDept' => "DPN-0004",
            'divisi_id' => 1,
            'txtNamaDept' => "PRD",
        ]);
    }
}
