<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email'=>'admin@admin.com',
                'password'=>'$2y$10$IfabwxNTAqcdfoaS5KSHt.OOqSV7U/.ThZiRH8zPcAwAzcqJUftpK',
                'activated'=>'1',
                'superuser'=>'1',
                'first_name'=>'superuser',
                'last_name'=>'superuser',
                'created_at'=>'2016-03-31 22:09:53',
                'updated_at'=>'2016-03-31 22:09:53',
            ]
        ]);
    }
}
