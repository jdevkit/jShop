<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\models\Role;
use \App\models\Permission;

class CreatingDefaultRolesAndPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $adminUser = new \App\User;
        $adminUser->name = 'Admin';
        $adminUser->email = 'admin@admin.com';
        $adminUser->password = bcrypt('qweqwe');
        $adminUser->save();

        $owner = new Role();
        $owner->name         = 'owner';
        $owner->display_name = 'Project Owner';
        $owner->description  = 'User is the owner of a given project';
        $owner->save();

        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'User Administrator';
        $admin->description  = 'User is allowed to manage and edit other users';
        $admin->save();

        $adminUser->attachRole($owner);

        $editPermission = new Permission();
        $editPermission->name         = 'edit-permissions';
        $editPermission->display_name = 'Edit Permissions';
        $editPermission->description  = 'edit user permissions';
        $editPermission->save();

        $editRoles = new Permission();
        $editRoles->name         = 'edit-roles';
        $editRoles->display_name = 'Edit Roles';
        $editRoles->description  = 'edit user roles';
        $editRoles->save();

        $editPost = new Permission();
        $editPost->name         = 'edit-post';
        $editPost->display_name = 'Edit Posts';
        $editPost->description  = 'edit blog posts';
        $editPost->save();

        $deletePost = new Permission();
        $deletePost->name         = 'delete-post';
        $deletePost->display_name = 'Delete Posts';
        $deletePost->description  = 'delete blog posts';
        $deletePost->save();

        $editUser = new Permission();
        $editUser->name         = 'edit-user';
        $editUser->display_name = 'Edit Users';
        $editUser->description  = 'edit existing users';
        $editUser->save();

        $deleteUser = new Permission();
        $deleteUser->name         = 'delete-user';
        $deleteUser->display_name = 'Delete Users';
        $deleteUser->description  = 'delete existing users';
        $deleteUser->save();

        $admin->attachPermissions([$editPost, $deletePost, $editUser, $deleteUser]);
        $owner->attachPermissions([$editPermission, $editRoles, $editPost, $deletePost, $editUser, $deleteUser]);
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
