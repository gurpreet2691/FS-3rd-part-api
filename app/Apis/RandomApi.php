<?php

namespace App\Apis;

use Illuminate\Support\Facades\Http;

class RandomApi {

    public static function getRandomUserData(int $limit = 1): array {
        $response = Http::get('https://randomuser.me/api/?results='. $limit);

        return $response->json()['results'];
    }
}
