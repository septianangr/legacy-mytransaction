<?php

Route::get('admin/home', [App\Http\Controllers\Admin\AdminHome::class, 'index'])
    ->name('admin.home');

Route::get('admin/users', [App\Http\Controllers\Admin\Users::class, 'index'])
    ->name('user.index');

Route::get('admin/users/get', [App\Http\Controllers\Admin\Users::class, 'get'])
    ->name('user.get');

Route::get('admin/users/add', [App\Http\Controllers\Admin\Users::class, 'create'])
    ->name('user.add');

Route::post('admin/users/save', [App\Http\Controllers\Admin\Users::class, 'store'])
    ->name('user.save');

Route::put('admin/users/update', [App\Http\Controllers\Admin\Users::class, 'update'])
    ->name('user.update');

Route::delete('admin/users/delete', [App\Http\Controllers\Admin\Users::class, 'destroy'])
    ->name('user.delete');

Route::get('admin/settings', [App\Http\Controllers\Admin\Settings::class, 'index'])
    ->name('setting.index');

Route::get('admin/settings/app', [App\Http\Controllers\Admin\Settings::class, 'app'])
    ->name('setting.app');

Route::put('admin/settings/app', [App\Http\Controllers\Admin\Settings::class, 'update_app'])
    ->name('setting.app.update');

Route::get('admin/settings/profile', [App\Http\Controllers\Admin\AdminProfile::class, 'index'])
    ->name('setting.profile');
