<?php

namespace App\Http\Controllers\admin;

use App\models\Permission;
use App\models\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index', ['user' => \Auth::user(),'users' => User::all()]);
    }

    public function editUser($id)
    {
        $redactUser = User::find($id);
        $roles = Role::all();

        return view('admin.users.edit', [
            'user' => \Auth::user(),
            'redactUser' => $redactUser,
            'roles' => $roles
        ]);
    }

    public function updateUser($id, Request $request)
    {
        $redactUser = User::find($id);
        $updateData = $request->except(['_method', '_token']);
        $redactUser->update($updateData);
        $redactUser->save();

        return redirect()->back()->with('message', 'Success!');
    }

    public function updateUserRoles($id ,Request $request)
    {
        $redactUser = User::find($id);
        $roles = $request->get('role');
        foreach ($roles as $roleId){
            $role = Role::find($roleId);
            if ($redactUser->hasRole($role->name)){
                continue;
            } else {
                $redactUser->attachRole($role);
            }
        }
        return redirect()->back()->with('message', 'Success!');
    }

    public function deleteUser($id)
    {
        $redactUser = User::find($id);
        $redactUser->delete();
        return redirect()->back()->with('message', 'Success!');
    }

    public function permissions()
    {
        $roles = Role::with('perms')->get();
        $permissions = Permission::all();

        return view('admin.users.permissions', [
            'user' => \Auth::user(),
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function getPermissions(Request $request){
        dd($request->all());
    }

    public function updateRole(Request $request){
        dd('update');
    }
}
