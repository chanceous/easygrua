<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Attachments\Location;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;

class ServiceController extends Controller
{
    public function index(BotMan $bot)
    {
        $this->askCarType($bot);
    }

    public function askCarType($bot)
    {
        $bot->ask('De que tamaño es tu auto?', function () use ($bot) {
            $this->say('Epera un momento, estamos buscando una grua cerca de tu ubicacion.');
            sleep(2);
            $this->showList($bot);
        });
    }

    public function showList($bot)
    {
        $coords = [
            [
                "lat" => "-34.574388",
                "lon" =>  "-58.448728"
            ],
            [
                "lat" => "-34.610565",
                "lon" =>  "-58.462117"
            ],
            [
                "lat" => "-34.61226",
                "lon" =>  "-58.434995"
            ]
            // "lat" => "-34.597",
            // "lon" =>  "-58.402723"
        ];
        foreach ($coords as $location) {
            $attachment = new Location($location['lat'], $location['lon'], [
                'custom_payload' => true,
            ]);
            $message = OutgoingMessage::create('Esta grua esta cerca de tu ubicacion:')
                ->withAttachment($attachment);
            $bot->reply($message);
        }
    }
}
