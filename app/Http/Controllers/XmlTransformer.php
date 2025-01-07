<?php

namespace App\Http\Controllers;

class XmlTransformer
{
    public static function transform($data, $rootElement = 'root')
    {
        $xml = new \SimpleXMLElement("<{$rootElement}/>");
        array_walk_recursive($data, function($value, $key) use ($xml) {
            if (XmlTransformer::isJson($value)) {
                // If the value is a JSON string, decode it
                $decoded = json_decode($value, true);
                // Create a new child node for the JSON object
                $jsonNode = $xml->addChild($key);
                // Add the JSON object's properties as child nodes
                array_walk_recursive($decoded, function($jsonValue, $jsonKey) use ($jsonNode) {
                    $jsonNode->addChild($jsonKey, htmlspecialchars((string)$jsonValue));
                });
            } else {
                // Add the value as text if it's not JSON
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
