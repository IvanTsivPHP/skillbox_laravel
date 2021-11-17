<?php

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AddAdminAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            'name' => config('admin.name'),
            'email' => config('admin.email'),
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'password' => Hash::make(config('admin.password')),
        ]);

        DB::table('roles')->insert([
            'name' => 'admin'
        ]);


        DB::table('role_user')->insert([
            'user_id' => User::where('email', config('admin.email'))->first()->id,
            'role_id' => Role::where('name', 'admin')->first()->id
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
