<?php

use App\Http\Controllers\PlaceToPayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/placetopay', PlaceToPayController::class);
