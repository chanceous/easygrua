<?php

namespace App\Http\Conversations;

class ServiceConversation extends Conversation
{
    public function askCarType()
    {
        $this->ask('De que tamaño es tu auto?', function (Answer $answer) {
            // Save result
            $this->firstname = $answer->getText();

            $this->say('Epera un momento, estamos buscando una grua cerca de tu ubicacion.');
            $this->showList();
        });
    }

    public function showList()
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

    public function run()
    {
        // This will be called immediately
        $this->askCarType();
    }
}
