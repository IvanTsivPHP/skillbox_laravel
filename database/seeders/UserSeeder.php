<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => config('admin.name'),
            'email' => config('admin.email'),
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'password' => Hash::make(config('admin.password')),
        ]);
    }
}
