<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    
    public function home(){
        $links = [
            'https://platzi.com'=>'Platzi',
            'https://www.epn.edu.ec/'=>'EPN',
            'https://esfot.epn.edu.ec/'=>'ESFOT'
        ];
        return view('welcome',[
            'links'=> $links
        ]);
    }

    public function about(){
        return view('about');
    }
}
