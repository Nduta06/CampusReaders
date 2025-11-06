<?php

namespace Database\Seeders;
use App\Models\roles;
use Illuminate\Support\Facades\Schema;                                                                                                                                                                                                                                                                      
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        roles::truncate();

        $admin = new Roles();
        $admin->name = 'Admin';
        $admin->description = 'Administrator with full access';
        $admin->save();

        $staff = new Roles();
        $staff->name = 'Staff';
        $staff->description = 'Librarian';
        $staff->save();

        $student = new Roles();
        $student->name = 'Student';
        $student->description = 'Student user';
        $student->save();
    }
}
