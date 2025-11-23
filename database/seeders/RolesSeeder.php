<?php

namespace Database\Seeders;
use App\Models\Role;
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
        Role::truncate();

        $admin = new Role();
        $admin->name = 'Admin';
        $admin->description = 'Administrator with full access';
        $admin->save();

        $staff = new Role();
        $staff->name = 'Staff';
        $staff->description = 'Librarian';
        $staff->save();

        $student = new Role();
        $student->name = 'Student';
        $student->description = 'Student user';
        $student->save();

        $guest = new Role();
        $guest->name = 'guest';
        $guest->description = 'Guest user';
        $guest->save();
    }
}
