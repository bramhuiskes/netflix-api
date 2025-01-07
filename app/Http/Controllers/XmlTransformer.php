<?php

namespace App\Http\Controllers;

class XmlTransformer
{
    public static function transform($data, $rootElement = 'root')
    {
        $xml = new \SimpleXMLElement("<{$rootElement}/>");
        array_walk_recursive($data, function($value, $key) use ($xml) {
            if (XmlTransformer::isJson($value)) {
                $decoded = json_decode($value, true);
                $jsonNode = $xml->addChild($key);
                array_walk_recursive($decoded, function($jsonValue, $jsonKey) use ($jsonNode) {
                    $jsonNode->addChild($jsonKey, htmlspecialchars((string)$jsonValue));
                });
            } else {
                $xml->addChild($key, htmlspecialchars((string)$value));
            }
        });

        return $xml->asXML();
    }

    static function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
