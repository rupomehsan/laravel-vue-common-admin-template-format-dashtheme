<?php

use App\Modules\BlogManagement\BlogCategory\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('blog-categories', Controller::class);
    Route::post('blog-category/bulk-action', [Controller::class, 'bulkAction']);
});
