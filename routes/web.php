<?php

use App\Livewire\DemoForm;
use App\Livewire\Form;
use App\Livewire\TestForm;

\Illuminate\Support\Facades\Route::get('form', Form::class);


Route::get('/demo',TestForm::class);
Route::get('/demo-form',DemoForm::class);
