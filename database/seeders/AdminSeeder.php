<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin
      //  $superId = Str::uuid()->toString(); // Re-use for role assignment
        DB::table('users')->insert([
         // /  'id' => $superId,
            'name' => 'super admin',
            'email' => 'superadmin@mail.com',
            'firstname' => 'super',
            'lastname' => 'admin',
            'is_admin' => '1',
            'password' => Hash::make('1234567890'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $superId =  DB::getPdo()->lastInsertId();
        // Assign super-admin Role
        $superAdmin = User::where('id',$superId)->first();
        $superAdmin->assignRole('admin');

        //create employee
       // $id = Str::uuid()->toString(); // Re-use for role assignment
        DB::table('users')->insert([
          //  'id' => $id,
            'name' => 'employee',
            'email' => 'employee@mail.com',
            'firstname' => 'employee',
            'lastname' => '',
            'is_admin' => '1',
            'password' => Hash::make('1234567890'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $id =  DB::getPdo()->lastInsertId();
        // Assign employee Role
        $admin = User::where('id',$id)->first();
        $admin->assignRole('employee');

        //create broker
        // $id = Str::uuid()->toString(); // Re-use for role assignment
        DB::table('users')->insert([
            //  'id' => $id,
            'name' => 'broker',
            'email' => 'broker@mail.com',
            'firstname' => 'broker',
            'lastname' => '',
            'is_admin' => '1',
            'password' => Hash::make('1234567890'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $id =  DB::getPdo()->lastInsertId();
        // Assign broker Role
        $admin = User::where('id',$id)->first();
        $admin->assignRole('broker');



    }
}
