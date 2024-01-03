<?php

use App\Modules\NewsPaper\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('news-papers', Controller::class);
    Route::post('news-papers/bulk-action', [Controller::class, 'bulkAction']);
});