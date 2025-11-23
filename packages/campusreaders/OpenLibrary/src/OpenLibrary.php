<?php

namespace CampusReaders\OpenLibrary;

use Illuminate\Support\Facades\Http;

class OpenLibrary
{
    public function search($query)
    {
        $response = Http::get(config('openlibrary.base_url') . '/search.json', [
            'q' => $query
        ]);

        return $response->json();
    }

    public function book($isbn)
    {
        $response = Http::get(config('openlibrary.base_url') . "/isbn/$isbn.json");

        return $response->json();
    }
}
