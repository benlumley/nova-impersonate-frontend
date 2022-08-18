<?php

use Illuminate\Support\Facades\Route;

Route::delete('unimpersonate', \BenLumley\NovaImpersonateFrontend\Http\Controllers\ImpersonateController::class.'@stopImpersonating')
     ->middleware(['web'])
     ->name('unimpersonate');
