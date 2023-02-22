<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('give-permission-to-role', function () {
    $permissions = Permission::get();

    $role = Role::findOrFail(1); // author

    $permission = Permission::findOrFail(1); //create article

    $role->givePermissionTo($permission);

    $role2 = Role::findOrFail(2); // editor

    $permission2 = Permission::findOrFail(2); //edit article
    $permission3 = Permission::findOrFail(3); //delete article

    $role2->givePermissionTo($permission2);

    $role3 = Role::findOrFail(3); // moderator

    $role3->givePermissionTo([$permission, $permission2, $permission3]);
    // $role->revokePermissionTo($permissions);
});


Route::get('assign-role-to-user', function () {
    $user = User::findOrFail(1); //bandan
    $user2 = User::findOrFail(2); //baba
    $user3 = User::findOrFail(3); //sai

    $role = Role::findOrFail(1); //author
    $role2 = Role::findOrFail(2); //editor
    $role3 = Role::findOrFail(3); //moderator

    $user->assignRole($role);
    $user2->assignRole($role2);
    $user3->syncRoles($role3);
});


Route::get('spatie-method', function () {
    $user = User::findOrFail(3);
    return $user->getPermissionsViaRoles();
});


// middleware
// https://spatie.be/docs/laravel-permission/v5/basic-usage/middleware


$user = User::findOrFail(3);
Auth::login($user);
// Auth::logout();

Route::get('create-article', function () {
    return dd('halaman ini hanya bisa di akses oleh author atau moderator');
})->middleware('role:author|moderator');

Route::get('edit-article', function () {
    return dd('halaman ini hanya bisa di akses oleh editor atau moderator');
})->middleware('role:editor|moderator');

Route::get('delete-article', function () {
    return dd('halaman ini hanya bisa di akses oleh moderator');
})->middleware('role:moderator');
