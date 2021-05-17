<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = Role::create([
            'name'=>'المدير العام',
            'display_name'=>'admin',
            'description'=>'can do anything in the project'
        ]);

        $operation = Role::create([
            'name'=>'مدير العمليات',
            'display_name'=>'operation Management',
            'description'=>'can do anything in the project'
        ]);

        $pharmacy = Role::create([
            'name'=>'مدير الصيدلة',
            'display_name'=>'pharmacy Management',
            'description'=>'can do anything in the project'
        ]);

        $pharmacovigilance = Role::create([
            'name'=>'مدير التيقظ الدوائي',
            'display_name'=>'pharmacovigilance Management',
            'description'=>'can do anything in the project'
        ]);

    }
}
