<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'=>'محمد الفاشق',
            'email'=>'admin@gmail.com',
            'phone'=>773773211,
            'district'=>'الامانة',
            'address'=>'الحي السياسي',
//            'adjective'=>'المدير العام  ',
            'password'=>bcrypt('admin')]);

        $admin->attachRole('المدير العام');

        $operation = User::create([
            'name'=>'عبده الشوافي',
            'email'=>'admin1@gmail.com',
            'phone'=>773773211,
            'district'=>'الامانة',
            'address'=>'الحي السياسي',
//            'adjective'=>'مدير العمليات ',
            'password'=>bcrypt('admin')]);

        $operation->attachRole('مدير العمليات');

        $pharmacy = User::create([
            'name'=>'منير الحريبي',
            'email'=>'admin2@gmail.com',
            'phone'=>773773211,
            'district'=>'الامانة',
            'address'=>'الحي السياسي',
//            'adjective'=>'مدير الصيدلة',
            'password'=>bcrypt('admin')]);

        $pharmacy->attachRole('مدير الصيدلة');

        $pharmacovigilance = User::create([
            'name'=>'عمر الجيلاني',
            'email'=>'admin3@gmail.com',
            'phone'=>773773211,
            'district'=>'الامانة',
            'address'=>'الحي السياسي',
//            'adjective'=>'مدير التيقظ الدوائي',
            'password'=>bcrypt('admin')]);

        $pharmacovigilance->attachRole('مدير التيقظ الدوائي');
    }
}
