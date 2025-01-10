<?php

namespace App\Http\Controllers;
use App\Http\Controllers\XmlTransformer;

class ResponseController
{
   static function respond($data, $status = 200)
   {
       $format = request() ->header('Accept');


       if (str_contains($format, 'application/xml'))
       {
           $xmlContent = XmlTransformer::transform($data);

           return response($xmlContent, $status);
       }

       return response() ->json($data, $status);
   }
}
