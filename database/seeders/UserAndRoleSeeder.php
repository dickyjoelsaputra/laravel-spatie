<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();
        $user = [
            [
                'name' => 'bandan',
                'email' => 'dandan@gmail.com',
                'password' => Hash::make('123'),
            ], [
                'name' => 'baba',
                'email' => 'baba@gmail.com',
                'password' => Hash::make('123'),
            ], [
                'name' => 'sai',
                'email' => 'sai@gmail.com',
                'password' => Hash::make('123'),
            ],

        ];

        foreach ($user as $value) {
            DB::table('users')->insert([
                'name' => $value['name'],
                'email' => $value['email'],
                'password' => $value['password'],
                'created_at' => Carbon::now(),
            ]);
        }

        $role = [
            [
                'name' => 'author',
                'guard_name' => 'web'
            ],
            [
                'name' => 'editor',
                'guard_name' => 'web'
            ],
            [
                'name' => 'moderator',
                'guard_name' => 'web'
            ],

        ];

        foreach ($role as $value) {
            DB::table('roles')->insert([
                'name' => $value['name'],
                'guard_name' => $value['guard_name'],
                'created_at' => Carbon::now(),
            ]);
        }

        $permission = [
            [
                'name' => 'create article',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit article',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete article',
                'guard_name' => 'web'
            ],

        ];

        foreach ($permission as $value) {
            DB::table('permissions')->insert([
                'name' => $value['name'],
                'guard_name' => $value['guard_name'],
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
