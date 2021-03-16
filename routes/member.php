<?php

Route::get('home', [App\Http\Controllers\Member\MemberHome::class, 'index'])
    ->name('member.home');

Route::get('profile', [App\Http\Controllers\Member\MemberProfile::class, 'index'])
    ->name('profile.index');

Route::get('transactions', [App\Http\Controllers\Member\Transactions::class, 'index'])
    ->name('mtrans.index');

Route::get('transactions/get', [App\Http\Controllers\Member\Transactions::class, 'get'])
    ->name('mtrans.get');

Route::get('transactions/add', [App\Http\Controllers\Member\Transactions::class, 'create'])
    ->name('mtrans.add');

Route::post('transactions/save', [App\Http\Controllers\Member\Transactions::class, 'store'])
    ->name('mtrans.save');

Route::delete('transactions/delete', [App\Http\Controllers\Member\Transactions::class, 'destroy'])
    ->name('mtrans.delete');
