<?php

use LaravelEnso\Core\app\Models\User;
use LaravelEnso\Core\app\Models\Owner;
use LaravelEnso\RoleManager\app\Models\Role;
use Illuminate\Database\Migrations\Migration;

class InsertDefaultUser extends Migration
{
    public function up()
    {
        $user = new User();
        $user->password = '$2y$10$.8UVV8LolWD540Dn6JBX8OFuzxMSKocM/zgLUu20.8SmysWtrppJy';
        $user->email = 'admin@teste.com.br';
        $user->username = 'admin';
        $user->first_name = 'Admin';
        $role = Role::whereName('admin')->first();
        $user->role_id = $role->id;
        $owner = Owner::whereName('Admin')->first();
        $user->owner_id = $owner->id;
        $user->is_active = true;
        $user->save();
    }

    public function down()
    {
        \DB::table('users')->delete();
    }
}
