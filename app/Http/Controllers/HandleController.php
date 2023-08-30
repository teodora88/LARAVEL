<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class HandleController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function uspesniOdgovor($podaci, $poruka)
    {
        $odgovor = [
            'uspesno' => true,
            'podaci'  => $podaci,
            'poruka' => $poruka,
        ];

        return response()->json($odgovor, 200);
    }


    /**
     * @return \Illuminate\Http\Response
     */
    public function greskaOdgovor($greska, $code = 404)
    {
        $odgovor = [
            'uspesno' => false,
            'poruka' => $greska,
        ];
        
        return response()->json($odgovor, $code);
    }
}
