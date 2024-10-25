<?php

use App\Http\Controllers\PlaceToPayController;
use Illuminate\Support\Facades\Route;

Route::get('/placetopay', [PlaceToPayController::class,'createSession']);
Route::get('/plactetopay-session/{requestId}', [PlaceToPayController::class,'getInformationOfSession']);
