<?php

namespace App\Http\Controllers;

use App\Apis\RandomApi;

class UserController
{
    public function getUsers()
    {
        $users = RandomApi::getRandomUserData(10);

        // sort the array by the last name
        usort($users, function ($item1, $item2) {
            return $item1['name']['last'] <=> $item2['name']['last'];
        });

        // create XML document
        $xml_data = new \SimpleXMLElement('<?xml version="1.0"?><data></data>');
        self::parseArrayToXml($users, $xml_data);

        return response($xml_data->asXML(), 200)->header('Content-Type', 'application/xml');
    }

    public static function parseArrayToXml(array $data, &$xml): string
    {
        foreach ($data as $key => $value ) {
            if (is_array($value)) {
                if ( is_numeric($key)) {
                    // this will keep track of the numeric index eg, 0
                    $key = 'index'.$key;
                }

                $subnode = $xml->addChild($key);
                self::parseArrayToXml($value, $subnode);
            } else {
                $xml->addChild("$key", htmlspecialchars("$value"));
            }
        }

        return $xml;
    }
}
