<?php

namespace App\Http\Controllers;

class XmlTransformer
{
    public static function transform(array $data, $rootElement = 'root')
    {
        $xml = new \SimpleXMLElement("<{$rootElement}/>");
        array_walk_recursive($data, function($value, $key) use ($xml) {
            $xml->addChild($key, $value);
        });

        return $xml->asXML();
    }
}
