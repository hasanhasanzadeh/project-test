<?php

use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\CostController;
use App\Http\Controllers\Panel\CustomerController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\PermissionController;
use App\Http\Controllers\Panel\RoleController;
use Illuminate\Support\Facades\Route;

Route::post('upload/photo',function (){
 return true;
})->name('photo.upload');

Route::prefix('panel')->middleware(['auth','PanelAccess'])->group(function ($route){

    $route->resource('/customers',CustomerController::class);
    $route->resource('/roles',RoleController::class);
    $route->resource('/permissions',PermissionController::class);
    $route->resource('/costs',CostController::class);
    $route->resource('/categories',CategoryController::class);

    $route->post('/costs/changes', [CostController::class, 'changes'])->name('costs.changes');

    $route->get('/dashboard',[DashboardController::class,'index'])->name('dashboard.admin');

    $route->get('/customer/search',[CustomerController::class,'search'])->name('customers.search');

    $route->post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
    $route->delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    $route->post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
    $route->delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');

    $route->get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    $route->delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    $route->post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
    $route->delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
    $route->post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
    $route->delete('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('users.permissions.revoke');

    $route->post('/make/slug',[DashboardController::class,'makeSlug'])->name('make.slug');
    $route->post('/tag/search',[DashboardController::class,'tagSearch'])->name('tag.search');
    $route->get('/permission/search',[PermissionController::class,'search'])->name('permission.search');
});
