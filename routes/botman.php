<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});


$botman->hears('necesito una grua', 'App\Http\Controllers\ServiceController@index');
